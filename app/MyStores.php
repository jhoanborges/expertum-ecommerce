<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyStores extends Model
{
    protected $table = 'mystores';
    protected $fillable = [];
    protected $guarded= ['id'];

      public function country()
    {
        return $this->hasOne('App\Paismodelo' ,'id' ,'country');
    }
    public function state()
    {
        return $this->hasOne('App\Estados' ,'id' ,'state');
    }
    public function city()
    {
        return $this->hasOne('App\Ciudades' ,'id' ,'city');
    }


    public function ecludedDays()
    {
        return $this->hasOne('App\ExcludeDay' ,'store_id' ,'id');
    }

    public function workingDays()
    {
        return $this->hasMany('App\WorkingDays' ,'store_id' ,'id');
    }


}
