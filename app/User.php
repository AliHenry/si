<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_id', 'google_id', 'github_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return ($this->role == 'admin'
            || $this->role == 'manager sells'
            || $this->role == 'manager plumbing'
            || $this->role == 'manager painting'
            || $this->role == 'manager ashaka cement'
            || $this->role == 'manager door and metro tiles'
            || $this->role == 'manager moulding and white cement'
            || $this->role == 'manager electrical'
            || $this->role == 'manager store auditor'
            || $this->role == 'manager sells auditor'
        );
    }

    public function profile()
    {
        return $this->hasOne(Employee::class);
    }

    public static function login($request)
    {
        $remember = $request->remember;
        $email = $request->email;
        $password = $request->password;
        return (\Auth::attempt(['email' => $email, 'password' => $password], $remember));
    }
}
