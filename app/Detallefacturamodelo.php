<?php
// Aqui nos conectamos anuestra tabla de formaspago para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallefacturamodelo extends Model
{
    protected $table = 'detallefactura';
	protected $fillable = ['id_factura','id_producto','id_provedor','referencia','nombreproducto','descripcionproducto','preciocosto','preciocosto_iva','precioventa','iva','precioventa_iva','cantidad','valorunitario','descuento','valor','valor_iva','valor_total','promocion','garantia'];
	public $timestamps = false;
}