<?php

namespace App\Entities;

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
use App\Traits\Filterable;
use URL;

class User extends Authenticatable implements JWTSubject, Searchable, MustVerifyEmail
{
    use Filterable, Notifiable, QueryCacheable;

    public $cacheFor = 3600;
    public $fire_events = true;

    protected static $flushCacheOnUpdate = true;
    protected $entity_type = 'users';
    protected $guarded = ['user_id'];
    protected $hidden = [
        'password', 'remember_token', 'first_name', 'last_name',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    private $searchIn = ['name', 'first_name', 'last_name', 'email'];


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
        if (!Auth::check()) return false;
        if ($this->role_id == "0") return true;
        if ($this->role->hasAccess($permission) !== true) return false;
        return true;
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
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) return response()->json(['message' => 'User not found', 'status' => 404], 404);
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'Token expired', 'status' => $e->getCode()], $e->getCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'Token invalid', 'status' => $e->getCode()], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token not present', 'status' => $e->getCode()], $e->getCode());
        }

        return $user;
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

    static function find($id)
    {
        $user = self::where(['email' => $id])->orWhere(['id' => $id])->first();
        return $user;
    }
}
