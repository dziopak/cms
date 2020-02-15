<?php

namespace App;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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
        $logs = Log::where('user_id', $this->id)->orWhere(['target_id' => $this->id, 'type' => 'USER']);
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

    public function hasAccessOrRedirect($permission) {
        if (!$this->hasAccess($permission)) {
            return redirect(route('admin.dashboard.index'));
        }
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            $user->account_logs()->delete();
            if ($user->avatar != "1") {
                unlink(public_path() . '/images/avatars/'.$user->photo->path);
                $user->photo()->delete();
            }
        });
    }
}
