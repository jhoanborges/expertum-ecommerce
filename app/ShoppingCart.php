<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ShoppingCart extends Model
{
    protected $table = 'shoppingcart';

    public static function deleteCartRecord($identifier, $instance)
    {
        $cart = static::where('identifier' , $identifier)->where('instance', $instance);
        $cart->delete();
    }

        public static function deleteFavoriteCartRecord($identifier, $instance)
    {
        $cart = static::where('identifier' , $identifier)->where('instance', $instance);
        $cart->delete();
    }
}
