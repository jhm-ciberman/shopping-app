<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'contact',
        'street_name',
        'country_code',
        'street_number',
        'additional_info',
        'between',
        'zip_code',
        'state',
        'city',
        'references',
        'phone',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'country_code' => 'ar',
        'zip_code'     => 7600,
        'city'         => 'Mar del Plata',
        'state'        => 'Buenos Aires',
    ];

    /**
     * {@inheritdoc}
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $address) {
            $address->geocode();
        });
    }

    /**
     * Replicates the address and freezes
     * 
     * @return \App\Address
     */
    public function replicateAndFreeze()
    {
        return tap($this->replicate()->freeze())->save();
    }

    /**
     * Sets the is_editable property to false
     * 
     * @return self
     */
    public function freeze()
    {
        $this->is_editable = false;
        return $this;
    }

    /**
     * Sets the is_editable property to true
     * 
     * @return self
     */
    public function unfreeze()
    {
        $this->is_editable = true;
        return $this;
    }

    /**
     * Updates the lattitude and longitude attributes using Geocoding
     */
    public function geocode()
    {
        $driver = config('cosechaexpress.geocoding');
        if (!$driver) {
            return;
        }

        $address = Geocoder::using($driver)->limit(1)->geocode($this->fullAddress)->first();
        
        if ($address) {
            $this->lattitude = $address->getLattitude();
            $this->longitude = $address->getLongitude();
        }
    }

    /**
     * Gets country name
     * 
     * @return  string
     */
    public function getCountryAttribute()
    {
        return country($this->country_code)->getName();
    }

    /**
     * Gets full city name with the format "Cityname, state zipcode"
     * 
     * @return  string
     */
    public function getFullCityAttribute()
    {
        return sprintf('%s, %s %s', $this->city, $this->state, $this->zip_code);
    }

    /**
     * Gets full address name with the format "Address 123, Cityname, state zipcode, country"
     * 
     * @return  string
     */
    public function getFullAddressAttribute()
    {
        return implode(', ', [$this->street, $this->fullCity, $this->country]);
    }

    /**
     * Gets full street name with street number included (if not null)
     * 
     * @return  string
     */
    public function getStreetAttribute()
    {
        return $this->street_number
            ? $this->street_name . ' '. $this->street_number
            : $this->street_name;
    }

    /**
     * The associated user
     * 
     * @var Illuminate\Database\Eloquent\Relations\HasUser
     */
    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The orders that has this address
     * 
     * @var Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders() 
    {
        return $this->belongsToMany('App\Order');
    }
}
