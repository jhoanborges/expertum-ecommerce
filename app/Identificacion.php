<?php
// Aqui nos conectamos anuestra tabla de tipoidentificacion para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\Builder;


class Identificacion extends Model
{
    protected $table = 'tipoidentificacion';
//	protected $fillable = ['nombre'];
    protected $guarded= ['id'];
    	protected $fillable = [];
	public $timestamps = false;

//order by default
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('nombre', 'asc');
        });
    }


}