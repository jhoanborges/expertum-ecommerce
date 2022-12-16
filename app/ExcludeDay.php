<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcludeDay extends Model
{
    protected $table = 'working_hours_excluded';
    protected $fillable = ['reason', 'date', 'store_id'];
}
