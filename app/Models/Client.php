<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'password', 'name', 'email', 'dob', 'last_donation_date', 'pin_code', 'blood_type_id', 'city_id','blood_type');

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }
    public function donations()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }
    protected $hidden = [
        'password', 'api_token',
    ];

}
