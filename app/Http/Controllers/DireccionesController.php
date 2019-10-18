<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Direcciones;
use Auth;


class DireccionesController extends Controller
{


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= Direcciones::create([
            'direccion' =>$request->direccion,
            'user_id' =>Auth::id(),
        ]);
    return response()->json(['id' => $data->id]);
    }




    public function select(Request $request)
    {
        $data= Direcciones::where('id', $request->id)->first();
     //   $data = json_encode($data);
     return response()->json([
        'id' => $data->id,
        'id_pais' => $data->id_pais,
        'id_departamento' => $data->id_departamento,
        'id_ciudad' => $data->id_ciudad,
        'direccion' => $data->direccion,
        'telefono' => $data->telefono,
        'name' => $data->name,
        'barrio' => $data->barrio,
        'tipo_identificacion' => $data->tipo_identificacion,
        'numero_identificacion' => $data->numero_identificacion,
        'observaciones' => $data->observaciones,

    ]);
   // return response()->json($data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
