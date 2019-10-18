<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
                protected $table = 'factura';
        protected $guarded = ['id'];
 		protected $fillable = [];
}
