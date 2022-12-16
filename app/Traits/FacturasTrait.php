<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Factura;
use App\Productomodelo;
use App\DetalleFactura;

trait FacturasTrait {

	public function createFacturaYDetalle($request, $valor_flete , $observaciones)
	{
		$total_productos=0;
	//creacion de factura y detalle factura
		$factura = Factura::create([
			'name' => $request->entregar,
			'email' => $request->email,
			'telefono' => $request->telefono,
			'tipo_identificacion' => isset(  $request->tipo_identificacion  ) ? $request->tipo_identificacion : 2,
			'numeroidentificacion' => $request->numero,
			'direccion' => $request->direccion,
			'observacion' => $observaciones,
			'id_ciudad' =>$request->city,
			'flete' =>$valor_flete,
		]);

		$nombres = '';
		$base_iva = 0;
		$subtotal=0;
		$total_iva=0;


		foreach (Cart::instance('default')->content() as $i => $producto){

			$product = Productomodelo::where('slug' , $producto->id)->first();

			$nombres = $nombres.$product->nombre_producto;

			$valor_producto = precioNew($product->slug)*$producto->qty;
			$precio_base    = round(($valor_producto  /  ($producto->options->iva/100 +1)), 2);
			if ($producto->options->iva != 0){
				$base_iva = $base_iva + $precio_base;
			}
			$subtotal       = $subtotal + $valor_producto ;
			$total_iva      = round($total_iva + ($valor_producto - $precio_base ), 2);

			$total = precioNew($product->slug);
			$total_productos = $total_productos + $total;

			$detalle_factura = DetalleFactura::create([
				'id_factura' =>$factura->id,
				'id_producto' =>$product->id,
				'id_provedor' => $product->id_provedor,
				'referencia' => $product->referencia,
				'name' => $product->nombre_producto,
				'descuento' => isset(    $product->hasManyPromociones->first()->tipo_promocion  ) ?  $product->hasManyPromociones->first()->tipo_promocion : null,
				'valor' =>isset(    $product->hasManyPromociones->first()->valor  ) ?  $product->hasManyPromociones->first()->valor : null,
				'iva' =>$product->iva,
				'total' => $total,
				'cantidad' =>$producto->qty,
			]);

			}//end foreach

			Factura::where('id', $factura->id)->update([
				'total_productos' => $total_productos,
				'total' => $subtotal + $valor_flete,
			]);

			return [
				'nombres' => $nombres,
				'base_iva' => $base_iva,
				'subtotal' => $subtotal,
				'total_iva' => $total_iva,
				'factura' => $factura,
				'total_productos' => $total_productos,
			];
		}



	}