<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\SEOTrait;

class SuccessController extends Controller
{
  use SEOTrait;

    public function index($ref_payco)
    {
        return view('layouts.success')->with([
            'reference'=>$ref_payco
        ]);
    }

        public function successfull()
    {
        return view('layouts.success')->with([
        ]);
    }


   public function notificationCallback(Request $request)
    {
        dd($request->all());
    }




   public function callback(Request $request)
    {
  $this->setSEOManager();

        $mdOrder = $request->mdOrder ?? null;
        $orderNumber = $request->orderNumber  ?? null;
        $operation = $request->operation ?? null;
        $status = $request->status ?? null;

        //1 exito y 0 para error
/*
        if($operation == 'approved'){
            $message = 'Compra exitosa.';
            $subtitle='Hemos recibido tu pago. Recibirás un correo con los detalles de tu compra';
        }else if($operation == 'deposited'){
            $message = 'Orden aprobada con estatus depositado';
            $subtitle='Has depositado tu pago. Contacta al administrador del sistema si no recibes un email en las siguientes 24 horas.';
        }else if($operation == 'reversed'){
            $message = 'Orden reversada';
            $subtitle='Contacta al administrador del sistema si no recibes un email en las siguientes 24 horas.';
        }else if($operation == 'refunded'){
            $message = 'Orden anulada';
            $subtitle='La orden ha sido anulada. Contacta al administrador del sistema para más detalles.';
        }else{
            $message = 'Estatus desconocido. Por favor, contacta al administrador del sistema.';
            $subtitle='No se ha recibido respuesta desde credibanco. Contacta al administrador del sistema para más detalles.';

        }*/

        $message = 'Estamos confirmando tu pago.';
        $subtitle='Si tu pago fué aprobado correctamente, recibirás un correo con los detalles de tu compra';

        return view('layouts.callback')->with([
            'reference'=>$mdOrder,
            'orderNumber'=>$orderNumber,
            'operation'=>$operation,
            'status'=>$status,
            'message'=>$message,
            'subtitle'=>$subtitle,
            'date'=>Carbon::now()->format('d/m/Y'),
        ]);
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
        //
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
