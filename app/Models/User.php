<?php

namespace App\Models;

use App\Events\EmailVerified;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'user_name',
        'email',
        'mobile',
        'profile_pic',
        'gender',
        'birth_date',
        'country_id',
        'city_id',
        'address',
        'password',
        'status',
        'referby',
        'referto',
        'last_login_ip',
        'activated_at',
        'last_login_at',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at'     => 'datetime',
        'activated_at'      => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function sendEmailVerificationNotification($guard = ''){
        event(new EmailVerified($this, $guard));
    }

    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach ($roles as $role){
                if($this->hasRole($roles)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }

        return false;
    }


    public function hasRole($role){
        if($this->roles()->where('nickname', $role)->first()){
            return true;
        }

        return false;
    }

    public function findById($id){
        return $this->query()->findOrFail($id);
    }

    public function createUser(array $data){
        return $this->query()->create($data);
    }
    
    public function updateUser(array $data, $id){
        $query = $this->findById($id);
        return $query->update($data);
    }

}
