<?php
// Aqui nos conectamos anuestra tabla de monedas para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Parametromodelo;

class Categorian1modelo extends Model
{

	protected $table = 'categoria_n1';
	protected $guarded = ['id'];
	protected $fillable = [];
	public $timestamps = false;

	    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('nombrecategoria', function (Builder $builder) {
            $builder->orderBy('nombrecategoria', 'ASC');
        });
    }


	public function productos(){	
		$parametros = Parametromodelo::first();

		if($parametros->store_show ==true){
		return $this->hasMany('App\Productomodelo', 'id_categorian1', 'slug');
		}else{
		return $this->hasMany('App\Productomodelo', 'id_categorian1', 'slug')->where('cantidad','>', 0);
		}
		//this->categoria1 -> tiene mcuhos ->poductos
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
