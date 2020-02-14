<?php

namespace App;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role_id', 'first_name', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function photo() {
        return $this->belongsTo('App\File', 'avatar');
    }

    public function logs() {
        return $this->hasMany('App\Log');
    }

    public function account_logs() {
        return $this->hasMany('App\Log', 'target_id');
    }

    public function hasAccess($permission) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role_id == "99") {
                return true;
            } else {
                $access = unserialize($user->role->access);
                if (in_array($permission, $access)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}
