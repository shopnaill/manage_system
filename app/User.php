<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','photo','admin'
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

    public static function getUserPageData($id)
    {
        $user = DB::table('users')
            ->where('users.id', $id)
            ->select('*')->first();      
        return $user;
    }


    public static function getUsersPageData()
    {
        if (User::isAdmin() || User::roles() !=null)
        {
            $users = DB::table('users')
            ->select('*')->get();      
        }
        elseif (!User::isAdmin() && User::roles() == null)
        {
         $users = null;
        }
        return $users;
    }

    public static function isAdmin()
    {
      return Auth::user()->admin;;
    }

    public static function roles()
    {
        return Auth::user()->role;
    }
}
