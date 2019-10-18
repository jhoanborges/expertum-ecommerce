<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametros;
use App\NewsLetter;
use Illuminate\Support\Facades\Crypt;

class NewsLetterController extends Controller
{


    public function cancelar_suscripcion($id)
    {
//esto es solo prueba falta optimizar encuentas o algo por el estilo ademas leer el email de millones de suscripciones podria ser lento
try {
  $newsletter= NewsLetter::where('token', $id)->update([
'active'=>false,
'token'=>null,
  ]);

if (!$newsletter) {
    //si no ocurre la actualizacion el link expiro
    toast('link invalido','info','top-right');
    return redirect()->route('welcome');
}

toast('tu suscripcion ha sido desabilitada. Aca se puede implementar otra vista. Ademas se podria hacer una notificacion para decirle al usuario lamentamos que te hayas ido con mas publicidad, encuestas etc','success','top-right');

return redirect()->route('welcome');


} catch (DecryptException $e) {
    //aca enviar un mensaje a la vista. esta excepcion significaria lo mas seguro que le usuario trato de cambiar el link encriptado
    dd($e);
}


   
    }


    public function store(Request $request)
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
