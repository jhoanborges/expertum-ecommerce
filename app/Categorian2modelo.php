<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parametromodelo;

class Categorian2modelo extends Model
{
    protected $table = 'categoria_n2';
	protected $guarded = ['id'];
	protected $fillable = [];
	public $timestamps = false;


/*QUERIDO COLEGA. Explicaci脫n. Segun la tarea 36, se deberan mostrar solo las categorias que contengan productos, sin embargo,  no existen relaciones. Razon: la base de datos fue implementada asi. */
/*Se me ocurri贸 traer la variable $ids donde se almacenan los id de los productos desde new controller, leer las categorias , filtras la coleccion y luego retornar las categorias que tienen productos*/
/*Quizas te preguntes porque y porque no ser铆a mejor relacionar todo desde cero y quizas te lo preguntes siempre.*/
/*Al igual que aca esta en todas las categorias. Excepto la categoria 1 donde  se leen los productos directamente*/

	public function hasProducts($ids)
{

	$categories=[];
	foreach ($ids as $cats) {
		$categories[] = $cats->slug;
	}

$parametros=Parametromodelo::first();
$query = Productomodelo::whereIn('id_categorian2',$categories)->where('estado', true);
$query->when($parametros->store_show== true, function ($q) {
    return $q;
});
$query->when($parametros->store_show== false, function ($q) {
    return $q->where('cantidad','>', 0);
});
$productos = $query->get();


$category=[];
	foreach ($productos as $cats) {
		$category[] =($cats->id_categorian2);
	}

	$collection = collect($category);
	$unique_data = $collection->unique()->values()->all();

    return Categorian2modelo::whereIn('slug',$unique_data)
->orderBy('nombrecategoria', 'ASC')
    ->get();

}




}
