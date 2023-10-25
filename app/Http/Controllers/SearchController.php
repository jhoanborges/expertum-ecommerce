<?php

namespace App\Http\Controllers;

use App\Categoria7;
use Illuminate\Http\Request;
use App\Productomodelo;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($searchData)
    {

$categoria7 = Categoria7::where('nombrecategoria', $searchData)->first();
$searchCat = $categoria7->id;

        $query = Productomodelo::whereHas('categoria7', function($q) use ($searchCat){
                $q->where('categoria7_id', $searchCat);
        });
//dd($query->get() ->pluck('id') );
        return view('layouts.store-clean')->with([
            'productos'=> $query->paginate(),
            'productos2'=> $query->get(),
            'searchData'=> $searchData,
            'marcas'=> [],
                 // 'categorias_principales'=> $categorias_principales,
            'selected'=> null,
            'pagination'=> null,
            'mostrar'=> null,
            'cat2'=> '',
            'id'=> '',
            'oldcat2'=> '',
            'cat'=> 1,
            'trmdeldia'=> null,
              //'categorias'=> $categorias,
              //'categorias'=> [], //devuelvo vacio para que no aparezcan las categorias en los resultados de busqueda
            'categorias_nombre'=> null,

            'filtrar_por_marcas'=> null,
            'filtrar_por_fitlers'=> null,
            'cont_mark'=> null,
            'projects'=> [],
            'ids'=> '',
            'ids2'=> '',
            'min'=>null,
            'max'=>null,
            'search_key'=> $searchData,
            'cat_search' => null,
            'idd'=>1,
            'checked'=>null,
            'search_like'=> null,
            'strict'=> null,
          ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
