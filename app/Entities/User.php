<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Modules\Users\UserEntity;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

use JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use Illuminate\Http\Exceptions\HttpResponseException;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Notifications\UserPasswordReset;
use App\Notifications\UserEmailVerification;
use App\Traits\EntityTrait;
use App\Factories\EntityFactory;
use URL;


class User extends Authenticatable implements JWTSubject, Searchable, MustVerifyEmail
{

    use Notifiable;
    use QueryCacheable;
    use EntityTrait;

    public $fire_events = true;
    protected $webEntity = UserEntity::class;

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role_id', 'first_name', 'last_name', 'last_login', 'updated_at', 'provider', 'provider_id'
    ];
    protected $hidden = [
        'password', 'remember_token', 'first_name', 'last_name',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;


    public function role()
    {
        return $this->belongsTo('App\Entities\Role');
    }


    public function photo()
    {
        return $this->belongsTo('App\Entities\File', 'avatar');
    }


    public function dashboard()
    {
        return $this->hasOne('App\Entities\Dashboard', 'user_id', 'id');
    }


    public function logs()
    {
        $logs = Log::where('user_id', $this->id)->orWhere('target_id', $this->id)->where('type', 'USER');
        return $logs;
    }


    public function account_logs()
    {
        return $this->hasMany('App\Entities\Log', 'user_id');
    }


    public function hasAccess($permission)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role_id == "0") return true;
            $access = unserialize($user->role->access);
            if (!is_array($access)) return false;

            if (in_array($permission, $access) && $user->is_active == 1) {
                return true;
            }
        }
        return false;
    }


    public function hasAccessOrRedirect($permission)
    {
        if (!Auth::check() || !$this->hasAccess($permission)) {
            throw new HttpResponseException(
                redirect()
                    ->route('admin.dashboard.index')
                    ->with("error", "You don't have access to perform this action.")
            );
        }
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }


    static function jwtUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getCode());
        }

        return $user;
    }


    public function scopeFilter($query, $request)
    {
        if (!empty($request->get('search'))) {

            // Search in name, first name, last name or email //
            $query->where('name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('first_name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('last_name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('email', 'like', '%' . $request->get('search') . '%');
        }
        if (!empty($request->get('sort_by'))) {
            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
                $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        } else {
            $query->orderByDesc('id');
        }
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            route('admin.users.edit', $this->id)
        );
    }

    public function sendPasswordResetNotification($token): void
    {
        $url = route('password.reset', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset()
        ]);
        $this->notify(new UserPasswordReset($url));
    }

    public function sendEmailVerificationNotification()
    {
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            \Illuminate\Support\Carbon::now()->addMinutes(\Illuminate\Support\Facades\Config::get('auth.verification.expire', 60)),
            [
                'id' => $this->getKey(),
                'hash' => sha1($this->getEmailForVerification()),
            ]
        );
        $this->notify(new UserEmailVerification($verifyUrl));
    }

    public function setPassword($request)
    {
        return EntityFactory::build($this->webEntity, $this)->setPassword($request);
    }

    public function disable()
    {
        return EntityFactory::build($this->webEntity, $this)->disable();
    }

    public function block()
    {
        return EntityFactory::build($this->webEntity, $this)->block();
    }

    static function find($id)
    {
        $user = self::where(['email' => $id])->orWhere(['id' => $id])->first();
        return $user;
    }
}
