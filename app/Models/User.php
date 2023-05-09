<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const USER_SUPER_ADMIN = 0;
    const USER_ADMIN = 1;
    const USER_USER = 2;

    const USER_NOT_ACTIVE = 0;
    const USER_ACTIVE = 1;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function findById($id){
        return self::Where('id',$id)->first();
    }

    static function findRole($id){
        $userRole= User::Where('id',$id)->first();
        if($userRole->is_admin == self::USER_SUPER_ADMIN){
            return 'Super Admin';
        }elseif($userRole->is_admin == self::USER_ADMIN){
            return 'Admin';
        }elseif($userRole->is_admin == self::USER_USER){
            return 'User';
        }
    }

  
}
