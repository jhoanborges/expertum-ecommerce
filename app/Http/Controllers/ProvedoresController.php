<?php
/**Aqui encontramos el controlador de la interfase de listado_provedores, en donde realizamos el metodo CRUD para dicha tabla; desde aquí también realizamos las validaciones para mostrar los errores a los usuarios en pantalla a través del archivo validation.php el cual se encuentra en resources/en/validation.php; a su vez nos conectamos con nuestros listados_provedores.blade que se encuentra en formularios/provedores y nuestro archivo de rutas web encontrado en route.

En el índex podemos apreciar que estamos realizando unos join para poder conectar la tabla con otra en este caso países, departamentos y ciudades para traer el nombre del país, departamento y ciudad.

Por otra parte también tenemos construida una función llamada buscar_provedores la cual se encarga de realizar la búsqueda en mi listado_provedores acorde a los parámetros pasados, en el índex también podemos ver la parte de la paginación la cual se encuentra de 20 en 20.

Aqui encontramos otra funcion llamada getdepartamentos y getciudades la cual funciona por medio de ajax y da la respuesta en join su fin es de que me trae los departamentos que corresponden a cada pais, para darle una mejor organizacion a los datos y entendimiento al usuario**/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Paismodelo;
use App\Departamentomodelo;
use App\Ciudadmodelo;
use App\Identificacion;
use App\Provedormodelo;
use App\Formapagomodelo;
use App\Tipocuentamodelo;
use App\Entidadbancariamodelo;
use App\Cuentabancariamodelo;
use DB;

class ProvedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provedores =DB:: table('provedores')
        ->join ('tipoidentificacion', 'tipoidentificacion.id', '=', 'provedores.id_tipoidentificacion')
        ->select('provedores.id','provedores.nombreprovedor','tipoidentificacion.nombre as tipo_identificacion','provedores.numerodocumento','provedores.nombrecontacto','provedores.telefonocontacto','provedores.direccion','provedores.correoelectronico','provedores.estado','provedores.manejactabancaria')
        ->orderby ('provedores.id', 'asc')
        ->paginate(20);
       //dd($departamentos);
        return view('listados.listado_provedores', compact('provedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdepartamentos(Request $request){
        $id_pais = $request->get('id_pais');
        $departamentos= Departamentomodelo::where('id_pais',$id_pais)->get();
        return response()->json($departamentos);
    }

    public function getciudades (Request $request){
        $id_departamento = $request->get('id_departamento');
        $ciudades= ciudadmodelo::where('id_departamento',$id_departamento)->get();
        return response()->json($ciudades);   
    }

    public function create()
    {
        $tipo_identificacion = Identificacion::orderBy('nombre','asc')->pluck('nombre','id');
        $paises = Paismodelo::orderBy('nombre_pais','asc')->pluck('nombre_pais','id');
        $departamentos = Departamentomodelo::orderBy('nombre_departamento','asc')->pluck('nombre_departamento','id');
        $formasdepago = Formapagomodelo::orderBy('nombre','asc')->pluck('nombre','id');
        $ciudades = ciudadmodelo::orderBy('nombre_ciudad','asc')->pluck('nombre_ciudad','id');
        $entidades= Entidadbancariamodelo::orderBy('nombre','asc')->pluck('nombre','id');
        $cuentas= Tipocuentamodelo::orderBy('nombretipocuenta','asc')->pluck('nombretipocuenta','id');
        $provedores =Provedormodelo::all();

        return view('formularios.provedores.create', compact('tipo_identificacion','paises','departamentos','formasdepago','provedores','ciudades','entidades','cuentas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $this->validate($request, [
            'nombreprovedor'=>'required|unique:provedores|max:60',
            'tipo_identificacion'=>'required',
            'numerodocumento'=>'required|unique:provedores|max:60',
            'nombrecontacto'=>'required|max:60',
            'telefono'=>'required|max:30',
            'telefonocontacto'=>'required|max:30',
            'direccion'=>'required|max:30',
            'correoelectronico'=>'required|email|max:60',
            'formasdepago'=>'required',
            'tiempopago'=>'required|numeric|max:200',
            'cuenta_bancaria'=>'required',
            'webservis'=>'required',
            'nombre_pais'=>'required',
            'nombre_departamento'=>'required',
            'nombre_ciudad'=>'required',
            'estado'=>'required',
            ]);

            $creado = Provedormodelo::create([
             'nombreprovedor' => $request->get('nombreprovedor'),
             'id_tipoidentificacion' => $request->get('tipo_identificacion'),
             'numerodocumento' => $request->get('numerodocumento'),
             'nombrecontacto' => $request->get('nombrecontacto'),
             'telefono' => $request->get('telefono'),
             'telefonocontacto' => $request->get('telefonocontacto'),
             'direccion' => $request->get('direccion'),
             'correoelectronico' => $request->get('correoelectronico'),
             'id_formapago' => $request->get('formasdepago'),
             'tiempopago' => $request->get('tiempopago'),
             'manejactabancaria' => $request->get('cuenta_bancaria'),
             'manejaws' => $request->get('webservis'),
             'id_pais' => $request->get('nombre_pais'),
             'id_departamento' => $request->get('nombre_departamento'),
             'id_ciudad' => $request->get('nombre_ciudad'),
             'estado' => $request->get('estado'),
             'id_entidadbancaria1' => $request->get('entidad'),
             'id_tipocuenta1' => $request->get('cuenta'),
             'numerocuenta1' => $request->get('numerocuenta'),
             'titular1' => $request->get('titular'),
             'id_entidadbancaria2' => $request->get('entidad2'),
             'id_tipocuenta2' => $request->get('cuenta2'),
             'numerocuenta2' => $request->get('numerocuenta2'),
             'titular2' => $request->get('titular2')
               ]);

                    $mensaje = $creado? 'Proveedor creado correctamente':'El proveedor no pudo ser creado';
                    return redirect()->route('listado_provedores.index')->with('mensaje',$mensaje);
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
        $id= Provedormodelo::find($id);
        $tipo_identificacion=DB:: table('tipoidentificacion')
        ->orderby ('nombre', 'asc')
        ->get();
        $paises =DB:: table('paises')
        ->orderby ('nombre_pais', 'asc')
        ->get();
        $departamentos=DB:: table('departamentos')
        ->orderby ('nombre_departamento', 'asc')
        ->get();
        $ciudades=DB:: table ('ciudades')
        ->orderby ('nombre_ciudad', 'asc')
        ->get();
        $formasdepago =DB:: table ('formaspago')
        ->orderby ('nombre', 'asc')
        ->get();
        $entidades= Entidadbancariamodelo::orderBy('nombre','asc')->pluck('nombre','id');
        $cuentas= Tipocuentamodelo::orderBy('nombretipocuenta','asc')->pluck('nombretipocuenta','id');
        //dd($id);
        return view('formularios.provedores.edit', compact('id','tipo_identificacion','paises','departamentos','ciudades','formasdepago','entidades','cuentas'));
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
        $id = Provedormodelo::find($id);
        $this->validate($request, [
            'nombreprovedor'=>'required|max:60',
            'tipo_identificacion'=>'required',
            'numerodocumento'=>'required|max:60',
            'nombrecontacto'=>'required|max:60',
            'telefono'=>'required|max:30',
            'telefonocontacto'=>'required|max:30',
            'direccion'=>'required|max:30',
            'correoelectronico'=>'required|email|max:60',
            'forma_pago'=>'required',
            'tiempopago'=>'required|numeric|max:200',
            'cuenta_bancaria'=>'required',
            'webservis'=>'required',
            'nombre_pais'=>'required',
            'nombre_departamento'=>'required',
            'nombre_ciudad'=>'required',
            'estado'=>'required',
            ]);
                ([
              $id->nombreprovedor=$request->get('nombreprovedor'),
              $id->id_tipoidentificacion=$request->get('tipo_identificacion'),
              $id->numerodocumento=$request->get('numerodocumento'),
              $id->nombrecontacto=$request->get('nombrecontacto'),
              $id->telefono=$request->get('telefono'),
              $id->telefonocontacto=$request->get('telefonocontacto'),
              $id->direccion=$request->get('direccion'),
              $id->correoelectronico=$request->get('correoelectronico'),
              $id->id_formapago=$request->get('forma_pago'),
              $id->tiempopago=$request->get('tiempopago'),
              $id->manejactabancaria=$request->get('cuenta_bancaria'),
              $id->manejaws=$request->get('webservis'),
              $id->id_pais=$request->get('nombre_pais'),
              $id->id_departamento=$request->get('nombre_departamento'),
              $id->id_ciudad=$request->get('nombre_ciudad'),
              $id->estado=$request->get('estado'),
              $id->id_entidadbancaria1=$request->get('id_entidadbancaria1'),
              $id->id_tipocuenta1=$request->get('id_tipocuenta1'),
              $id->numerocuenta1=$request->get('numerocuenta1'),
              $id->titular1=$request->get('titular1'),
              $id->id_entidadbancaria2=$request->get('entidad2'),
              $id->id_tipocuenta2=$request->get('cuenta2'),
              $id->numerocuenta2=$request->get('numerocuenta2'),
              $id->titular2=$request->get('titular2')
                        ]);
                //dd($id);
                $update = $id->save();
                $mensaje = $update? 'Proveedor actualizado correctamente':'El Proveedor no pudo actualizarce';
                return redirect()->route('listado_provedores.index')->with('mensaje',$mensaje);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buscar_provedor(Request $request){
    //Busca un provedor en listar provedores

    $dato=$request->get("dato_buscado");
     $provedores =DB:: table('provedores')
        ->join ('tipoidentificacion', 'tipoidentificacion.id', '=', 'provedores.id_tipoidentificacion')
        ->select('provedores.id','provedores.nombreprovedor','tipoidentificacion.nombre as tipo_identificacion','provedores.numerodocumento','provedores.nombrecontacto','provedores.telefonocontacto','provedores.direccion','provedores.correoelectronico','provedores.estado')
       ->where("provedores.nombreprovedor","like","%".$dato."%")->orwhere("provedores.numerodocumento","like","%".$dato."%")->orwhere("provedores.nombrecontacto","like","%".$dato."%")->orwhere("provedores.correoelectronico","like","%".$dato."%")
       ->orderby ('provedores.id', 'asc')
       ->paginate(20);
    return view('listados.listado_provedores')->with("provedores",$provedores);
      }

    public function destroy($id)
    {
        //No se puede eliminar ya que pertenece el id al producto y quedaria huerfano
    }
}
