<?php
// Aqui nos conectamos anuestra tabla de monedas para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parametromodelo;

class Categorian3modelo extends Model
{
    protected $table = 'categoria_n3';
    protected $guarded = ['id'];
    protected $fillable = [];
	public $timestamps = false;

	public function productos(){	
		return $this->hasMany('App\Productomodelo', 'id_categorian3', 'slug');
	}

	public function hasProducts($ids)
{

	$categories=[];
	foreach ($ids as $cats) {
		$categories[] = $cats->slug;
	}


$parametros=Parametromodelo::first();
$query = Productomodelo::whereIn('id_categorian3',$categories)->where('estado', true);
$query->when($parametros->store_show== true, function ($q) {
    return $q;
});
$query->when($parametros->store_show== false, function ($q) {
    return $q->where('cantidad','>', 0);
});
$productos = $query->get();

$category=[];
	foreach ($productos as $cats) {
		$category[] =($cats->id_categorian3);
	}

	$collection = collect($category);
	$unique_data = $collection->unique()->values()->all();

    return Categorian3modelo::whereIn('slug',$unique_data)
->orderBy('nombrecategoria', 'ASC')
    ->get();
}

}
