<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

        protected $table = 'products';
protected $fillable = ['name', 'slug', 'price', 'description'];

  public function categories() {
    return $this->belongsToMany('App\Category', 'products_categories');
  }
/*

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

*/

  public function scopeCategorized($query, Category $category=null) {
    if ( is_null($category) ) return $query->with('categories');

    $categoryIds = $category->getDescendantsAndSelf()->pluck('id');

    return $query->with('categories')
      ->join('products_categories', 'products_categories.product_id', '=', 'products.id')
      ->whereIn('products_categories.category_id', $categoryIds);
  }



}
