<?php
// Aqui nos conectamos anuestra tabla de monedas para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;


class Categorian1modelo extends Model
{

	protected $table = 'categoria_n1';
	protected $guarded = ['id'];
	protected $fillable = [];
	public $timestamps = false;


	public function productos(){	
		//this->categoria1 -> tiene mcuhos ->poductos
		return $this->hasMany('App\Productomodelo', 'id_categorian1', 'slug');
	}


//yano

	public function hasProducts($ids){	
		$t = Productomodelo::whereIn('id_categorian1',$ids)->get();
		$category =[];
		foreach ($t as $cats) {
			$category[] =($cats->id_categorian1);
		}

		$collection = collect($category);
		$unique_data = $collection->unique()->values()->all(); 

		return Categorian1modelo::whereIn('slug',$unique_data)
		->orderBy('nombrecategoria', 'ASC')
		->get();
	}



	
}
