<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaferboOptions extends Model
{
                protected $table = 'saferbo_options';
        protected $fillable = [];
		protected $guarded = ['id'];
}
