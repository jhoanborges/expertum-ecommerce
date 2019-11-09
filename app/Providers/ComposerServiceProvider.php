<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;

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
            foreach (Cart::instance('default')->content() as $productos) {
                $total = $total + precioNew($productos->id)*$productos->qty;
            }
            $view->with('total', $total );

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
