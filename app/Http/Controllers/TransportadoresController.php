<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transportadores;

use App\Http\Controllers\Includes\Flete_Saferbo;

class TransportadoresController extends Controller
{




    public function flete_value(Request $request){

        //$saf = Transportadores::first();
        $trans = Transportadores::where("estado", 1)->first();


        switch ($trans->id){
            case 1: //Saferbo. No se puede cambiar este código en la base de datos
                $servicio = new Flete_Saferbo();
                return $servicio->flete($request,$trans->id) ;
                //return formatPrice($servicio->flete($request,$trans->id));

                break;

            default:
                return 111111;

        }


    }

}
