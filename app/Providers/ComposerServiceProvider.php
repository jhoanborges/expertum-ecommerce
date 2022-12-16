<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Productomodelo;

class ComposerServiceProvider extends ServiceProvider
{
    /*
https://laravel.com/docs/5.1/views#view-composers
https://stackoverflow.com/questions/35314031/laravel-how-to-access-session-value-in-appserviceprovider/35314367#35314367
    */
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view)
        {

            $total=0;
            $total_iva=0;
            $subtotal=0;

            foreach (Cart::instance('default')->content() as $product) {

                $valor_producto = precioNew($product->id)*$product->qty;
                $precio_base    = ($valor_producto  /  ($product->options->iva/100 +1));
                $subtotal       = $subtotal + $precio_base;
                $total_iva      = $total_iva + ($valor_producto - $precio_base );
            }
            $total=$total_iva+$subtotal;
            $view->with('total', $total );



            $allFilters= Productomodelo::
            where('estado', true)
            ->where('productos.cantidad', '!=', 0)
            ->pluck('id');
            $view->with('allFilters', $allFilters );


/*
$action = app('request')->route();
if (!$action==null) {
         $action = $action->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);
           $view->with('controllerName', $controller );
}else{
           $view->with('controllerName', 'no hay controlador' );
}
*/


        });

        view()->composer(
            [
                'total',
                'controllerName'
        ]
            , function ($view) {
        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
