<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametromodelo;
use App\Transportadores;
use Spatie\Sitemap\SitemapGenerator;


class HomeController extends Controller
{
    public function generatesitemap () {

        SitemapGenerator::create(  \Request::root() )
        ->getSitemap()
            ->writeToFile(public_path('sitemap.xml'));


        dd('sitemap generates visit '.\Request::root().'/sitemap.xml');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  /*  public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function typeahead(Request $request)
    {

        $query = $request->get('query');
        $filterResult = Transportadores::
        where('nombretrasportador', 'LIKE', '%'. $query. '%')
        ->orWhere('direccion', 'LIKE', '%'. $query. '%')
        ->orWhere('telefono', 'LIKE', '%'. $query. '%')
        ->orWhere('correoelectronico', 'LIKE', '%'. $query. '%')
        ->orWhere('estado', 'LIKE', '%'. $query. '%')
        ->orWhere('codigo', 'LIKE', '%'. $query. '%')
        ->orWhere('code', 'LIKE', '%'. $query. '%')
        ->orWhere('url', 'LIKE', '%'. $query. '%')
        ->pluck('nombretrasportador');
        
        return response()->json($filterResult , 200);
    }
}
