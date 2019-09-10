<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
        'is_admin' => 'boolean',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_admin' => false,
    ];

    
     /**
     * All the carts associated to the user (can be many)
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

     /**
     * The cart associated to the user, if any (can be null)
     * 
     * @return App\Cart
     */
    public function getCartAttribute()
    {
        return $this->carts()->latest()->first();
    }

    /**
     * The orders dispatched by the user
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * The addresses associated to this user
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Address')->where('is_editable', '=', true);
    }

    /**
     * Adds a new Address to this User
     * 
     * @param  array  $data
     * @return \App\Address
     */
    public function addAddress(array $data)
    {
        $address = new Address($data);
        $address->is_editable = true;
        return $this->addresses()->save($address);
    }
}
