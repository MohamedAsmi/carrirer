<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Service\UserService;
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
        'first_name',
        'last_name',
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

    public function isAdmin()
    {
        return $this->is_admin === 1; 
    }
    
    public function settings()
    {
        return $this->belongsToMany(Setting::class, 'user_setting')->withTimestamps();
    }
    
    public function marketplaces()
    {
        return $this->belongsToMany(Marketplace::class, 'user_marketplaces')->withTimestamps();
    }
    
    public static function getUserSettingByKey($userId, $key, $parent_key)
    {
        $parent_id = Setting::getSettingByKey($parent_key)->id;
        return (new UserService)->getUserSettingByKey($userId, $parent_id, $key);
    }
  
}
