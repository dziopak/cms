<?php

namespace App;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Events\Users\UserCreateEvent;
use App\Events\Users\UserUpdateEvent;
use App\Events\Users\UserDestroyEvent;

use JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    public $fire_events = true;
    
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role_id', 'first_name', 'last_name', 'last_login'
    ];
    protected $hidden = [
        'password', 'remember_token', 'first_name', 'last_name',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role() {
        return $this->belongsTo('App\Role');
    }


    public function photo() {
        return $this->belongsTo('App\File', 'avatar');
    }


    public function dashboard() {
        return $this->hasOne('App\Dashboard','user_id', 'id');
    }


    public function logs() {
        $logs = Log::where('user_id', $this->id)->orWhere('target_id',$this->id)->where('type','USER');
        return $logs;
    }


    public function account_logs() {
        return $this->hasMany('App\Log', 'user_id');
    }


    public function hasAccess($permission) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role_id == "0") {
                return true;
            } else {
                $access = unserialize($user->role->access);
                if (in_array($permission, $access) && $user->is_active == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }


    public function hasAccessOrRedirect($permission) {
        if (!$this->hasAccess($permission)) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(redirect()->route( 'admin.dashboard.index' )->with("error", "You don't have access to perform this action."));
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


    static function jwtUser() {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return $user;
    }


    public function scopeFilter($query, $request) {
        if (!empty($request->get('search'))) {

            // Search in name, first name, last name or email //
            $query->where('name', 'like', '%'.$request->get('search').'%')
            ->orWhere('first_name', 'like', '%'.$request->get('search').'%')
            ->orWhere('last_name', 'like', '%'.$request->get('search').'%')
            ->orWhere('email', 'like', '%'.$request->get('search').'%');
        
        }
        if (!empty($request->get('sort_by'))) {

            // Sort by selected field //
            !empty($request->get('sort_order')) && $request->get('sort_order') === 'desc' ?
            $query->orderByDesc($request->get('sort_by')) : $query->orderBy($request->get('sort_by'));
        
        }
    }


    public static function boot() {
        parent::boot();
        $request = request();

        static::deleting(function($user) {
            $user->account_logs()->delete();
            if ($user->avatar != "1") {
                unlink(public_path() . '/images/'.$user->photo->path);
                $user->photo()->delete();
            }
        });

        self::created(function($user) use ($request) {
            if ($user->fire_events) event(new UserCreateEvent($user, $request->file('avatar')));
        });

        self::updated(function($user) use ($request) {
            if ($user->fire_events) event(new UserUpdateEvent($user, $request->file('avatar')));
        });

        self::deleted(function($user) {
            if ($user->fire_events) event(new UserDestroyEvent($user));
        });
    }
}
