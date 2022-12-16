<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parametromodelo;
class Categorian5modelo extends Model
{
	protected $table = 'categoria_n5';
	protected $guarded = ['id'];
	protected $fillable = [];
	public $timestamps = false;

	public function productos(){	
		return $this->hasMany('App\Productomodelo', 'id_categorian5', 'slug');
	}

	public function hasProducts($ids)
	{
		$categories=[];
		foreach ($ids as $cats) {
			$categories[] = $cats->slug;
		}
		$parametros=Parametromodelo::first();
		$query = Productomodelo::whereIn('id_categorian5',$categories)->where('estado', true);
		$query->when($parametros->store_show== true, function ($q) {
			return $q;
		});
		$query->when($parametros->store_show== false, function ($q) {
			return $q->where('cantidad','>', 0);
		});
		$productos = $query->get();

		$category=[];
		foreach ($productos as $cats) {
			$category[] =($cats->id_categorian5);
		}

		$collection = collect($category);
		$unique_data = $collection->unique()->values()->all();

		return Categorian5modelo::whereIn('slug',$unique_data)
		->orderBy('nombrecategoria', 'ASC')
		->get();
	}


}
