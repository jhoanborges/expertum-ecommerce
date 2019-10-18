<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMarcas extends Model
{
            protected $table = 'product_marcas';
    protected $fillable = ['product_id', 'marca_id'];
}
