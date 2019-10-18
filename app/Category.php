<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      protected $table = 'categories';
		
		public $fillable = ['name','parent_id'];

/*
  public function products() {
    return $this->belongsToMany('Product', 'products_categories');
  }
*/

    public function products() {
    return $this->belongsToMany('App\Productomodelo', 'products_categories');
  }


}
