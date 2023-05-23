<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Categorian1modelo;
use App\Ciudades;
use App\Estados;
use App\RedesSociales;
use App\Parametromodelo;
use DB;
use App\Footer;
use Session;
use App\Trm;
use App\Slider;
use App\Productomodelo;
use Illuminate\Support\Facades\Validator;
use Spatie\SchemaOrg\Schema as SchemaSpatie;
use Spatie\SchemaOrg\Graph;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {

    Paginator::defaultView('vendor.pagination.bootstrap-4');


    Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');

    Schema::defaultStringLength(191);
    View::composer('errors::404', function ($view) {
      //  $categorias=Categorian1modelo::orderBy('nombrecategoria' ,   'asc')->get();
      $cat2 = 1;
      $id = null;
      $view->with([
        //  'categorias' => $categorias ,
        'cat2' => $cat2,
        'id' => $id,
      ]);
    });

  /*
    $cat2 = 1;
    $id = null;
    View::share('cat2', $cat2);
    View::share('id', $id);
*/

    /**
        View::composer(
            'index', 'App\Http\ViewComposers\IndexComposer'
        );
     */
    $parametros =  Parametromodelo::first();

    $pais = Parametromodelo::first()->join('country', 'parametros.pais', 'country.id')
      ->select('country.country')
      ->value('country');
    $estado = Parametromodelo::first()->join('region', 'parametros.estado', 'region.id')
      ->select('region.region')
      ->value('region');
    $ciudad = Parametromodelo::first()->join('city', 'parametros.ciudad', 'city.id')
      ->select('city.city')
      ->value('city');
    $param = DB::table('parametros')
      ->first();




    View::share('telefono1', $parametros->numerocontacto);
    View::share('telefono2', $parametros->telefono);
    // View::share('email', $parametros->correo);
    View::share('pais', $pais);
    View::share('estado', $estado);
    View::share('ciudad', $ciudad);
    View::share('direccion', $parametros->direccion);
    View::share('nombre_tienda', $parametros->nombre_tienda);
    View::share('param', $param);
    $redes = RedesSociales::all();
    View::share('redes', $redes);

    $oldcat2 = null;
    $id = null;
    View::share('oldcat2', $oldcat2);
    View::share('idd', $id);



    $footer = Footer::with('items')->get();
    View::share('footer', $footer);


    $segmendatas = Ciudades::where('segmentada', true)->orderBy('city', 'ASC')->get();
    $departamentos = Estados::orderBy('region', 'ASC')->get();

    $cat_search = null;
    View::share('cat_search', $cat_search);
    View::share('segmendatas', $segmendatas);
    View::share('departamentos', $departamentos);

    $trm = Trm::orderBy('fecha', 'DESC')->first();

    if (empty($trm)) {
      app('App\Http\Controllers\TrmController')->webservistrm();
    }

    View::share('trm', $trm);


    $sliders = collect([]);
    View::share('sliders', $sliders);


    $top = Productomodelo::with('hasManyImagenes')
      ->where('destacado', true)
      ->get();
    View::share('top', $top);


    $this->app['events']->listen('session.started', function () {
      dd($this->app['session']->all());
    });




    $categorias = Categorian1modelo::has('productos')->orderBy('nombrecategoria',   'asc')->get();

    View::share('categorias', $categorias);

    //$categ= DB::table('categoria_n1')->get();


    $categoriasBoot = Categorian1modelo::has('productos')
      ->orderBy('nombrecategoria',   'asc')->get();


    View::share('categoriasBoot', $categoriasBoot);

    $localBusiness = SchemaSpatie::localBusiness()
      ->name($param->nombre_tienda)
      ->email($param->correo)
      ->contactPoint(SchemaSpatie::contactPoint()->areaServed('Worldwide'));
    $schema_org = $localBusiness->toScript();

    View::share('schema_org', $schema_org);


    $graph = new Graph();

    $graph
      ->organization()
      ->name($param->nombre_tienda);
    // Create a product and prelink organization
    $graph
      ->product()
      ->name($param->nombre_tienda)
      ->brand($graph->organization());
    View::share('graph', $graph);
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
