<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name','email', 'password', 'cellphone_number', 'user_type_id'
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
        'last_login' => 'datetime',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function hostings()
    {
        return $this->hasMany(Hosting::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function collaborations()
    {
        return $this->hasMany(Collaborator::class);
    }
    public function scopeName($query , $name){
        if($name)
            return $query->where('name','LIKE', "%$name%");
    }

    public function is_admin(){
        if($this->user_type_id == 1 ){
            return true;
        }
        return false;
    }
}
