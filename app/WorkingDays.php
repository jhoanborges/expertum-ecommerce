<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingDays extends Model
{
    protected $table = 'working_days';
    protected $fillable = ['metadata', 'store_id'];
    protected $appends = ['meta'];

    public function getMetaAttribute() {
        $metadata =  $this->attributes['metadata'];
      return $metadata!= null ? unserialize($metadata) :[];
      }

/*
    public function getMetaValueAttribute($value)  {
        return @unserialize($value) !== false ? unserialize($value) : $value;
     }
*/
}
