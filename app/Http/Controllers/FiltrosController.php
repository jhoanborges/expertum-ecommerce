<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria7;
use DB;
use Carbon\Carbon;
class FiltrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


  public function show(Request $request)
    {
     $array=    [
 "sort" => "menor_mayor",
  "mostrar" => "2"
];
    $now=Carbon::now()->format('Y-m-d');
        $categoria7 = Categoria7::find($request->id);

        $productos= $categoria7->productos()->filter($array)
        ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
->select('productos.*', 'imgproductos.*')
->groupBy('productos.referencia')
       ->paginateFilter();

        $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();

             return view('partials.product-grid-area', compact('productos', 'trmdeldia'));
        /*
        $html = view('partials.product-grid-area')->with([
'productos'=>$productos,
'trmdeldia'=>$trmdeldia,
        ])->render();

        return response()->json(compact('html'));
        */
    }






  public function server_show(Request $request)
    {

        $categoria7 = Categoria7::find($request->id);
        $productos= $categoria7->productos()->get();
  
        return redirect()->back()->with([
            'productos'=>$productos,
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
