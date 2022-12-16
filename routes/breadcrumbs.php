<?php
use App\Productomodelo;
use App\Imgproductomodelo;
use App\Categorian1modelo;
use App\Categorian2modelo;
use App\Categorian3modelo;
use App\Categorian4modelo;
use App\Categorian5modelo;





// Home
Breadcrumbs::register('welcome', function($breadcrumbs)
{
  if  (  session()->get('main')==1 ){
 $breadcrumbs->push('Inicio', route('welcome'));
}else{
  $breadcrumbs->push('Inicio', route('welcome'));
}
  
});


//login
Breadcrumbs::register('password.reset', function($breadcrumbs) {
  $breadcrumbs->parent('welcome');
  //$breadcrumbs->push('CATEGORIAS', route('store.index'));
  $breadcrumbs->push('Iniciar sesión', route('login'));
  $breadcrumbs->push('Recuperación de contraseña');
});



//login
Breadcrumbs::register('login', function($breadcrumbs) {
  $breadcrumbs->parent('welcome');
  $breadcrumbs->push('Iniciar sesión', route('login'));
});




// Home > store
Breadcrumbs::register('store.index', function($breadcrumbs) {

  $breadcrumbs->parent('welcome');
  //$breadcrumbs->push('CATEGORIAS', route('store.index'));
  $breadcrumbs->push('Categorías', route('welcome'));
});


Breadcrumbs::register('store.search', function($breadcrumbs) {

  $breadcrumbs->parent('welcome');
  //$breadcrumbs->push('CATEGORIAS', route('store.index'));
  $breadcrumbs->push('Categorías', route('welcome'));
  $breadcrumbs->push('Búsqueda');

});



Breadcrumbs::register('categoria.get', function($breadcrumbs, $cat, $id) {

    $breadcrumbs->parent('store.index');


    if ($cat==1) {

      $category= Categorian1modelo::where('id', $id)->first();
    $actual= Categorian1modelo::where('slug', $id)->first();

    }

    if ($cat==2) {

      $id_categorian1= Categorian2modelo::select('id_categorian1')->where('slug', $id)->value('id_categorian1');

      $actual= Categorian2modelo::where('slug', $id)->first();

      $category= Categorian1modelo::where('slug', $id_categorian1)->first();
        $breadcrumbs->push(ucfirst($category->nombrecategoria), route('categoria.get', [$cat-1, $id_categorian1])  );
    }

        if ($cat==3) {
   
      $id_categorian2= Categorian3modelo::select('id_categorian2')->where('slug', $id)->value('id_categorian2');

      $actual= Categorian3modelo::where('slug', $id)->first();

      $category= Categorian2modelo::where('slug', $id_categorian2)->first();

      $id_categorian1= Categorian1modelo::where('slug', $category->id_categorian1)->first();
   
      $category1= Categorian1modelo::where('slug', $id_categorian1)->first();
    
     $breadcrumbs->push(ucfirst($id_categorian1->nombrecategoria), route('categoria.get', [$cat-2, $id_categorian1->slug])  );
       $breadcrumbs->push(ucfirst($category->nombrecategoria), route('categoria.get', [$cat-1, $id_categorian2])  );

//        $breadcrumbs->push($category->nombrecategoria, route('categoria.get', [$cat-1, $id_categorian2])  );
    }
/*
     if ($cat==3) {
   
      $id_categorian2= Categorian3modelo::select('id_categorian2')->where('slug', $id)->value('id_categorian2');

      $actual= Categorian3modelo::where('slug', $id)->first();
      $category= Categorian2modelo::where('slug', $id_categorian2)->first();

      $id_categorian1= Categorian1modelo::where('slug', $category->id_categorian1)->first();
 
      $category1= Categorian1modelo::where('slug', $id_categorian1)->first();
     // $breadcrumbs->push($id_categorian1->nombrecategoria, route('categoria.get', [$cat-2, $id_categorian2])  );
        $breadcrumbs->push(ucfirst($category->nombrecategoria), route('categoria.get', [$cat-1, $id_categorian2])  );
    }
*/
     if ($cat==4) {
   
      $id_categorian3= Categorian4modelo::select('id_categorian3')->where('slug', $id)->value('id_categorian3');
      $actual= Categorian4modelo::where('slug', $id)->first();
      $category= Categorian3modelo::where('slug', $id_categorian3)->first();
      $id_categorian2= Categorian2modelo::where('slug', $category->id_categorian2)->first();

       $id_categorian1= Categorian1modelo::where('slug', $id_categorian2->id_categorian1)->first();

   $breadcrumbs->push(ucfirst($id_categorian1->nombrecategoria), route('categoria.get', [$cat-3, $id_categorian1->slug])  );
      $breadcrumbs->push(ucfirst($id_categorian2->nombrecategoria), route('categoria.get', [$cat-2, $id_categorian2->slug])  );
        $breadcrumbs->push(ucfirst($category->nombrecategoria), route('categoria.get', [$cat-1, $id_categorian3])  );
    }


     if ($cat==5) {
   
      $id_categorian4= Categorian5modelo::select('id_categorian4')->where('slug', $id)->value('id_categorian4');
      $actual= Categorian5modelo::where('slug', $id)->first();
      $category= Categorian4modelo::where('slug', $id_categorian4)->first();


      $id_categorian3= Categorian3modelo::where('slug', $category->id_categorian3)->first();
      $id_categorian2= Categorian2modelo::where('slug', $id_categorian3->id_categorian2)->first();
      $id_categorian1= Categorian1modelo::where('slug', $id_categorian2->id_categorian1)->first();

$breadcrumbs->push(ucfirst($id_categorian1->nombrecategoria), route('categoria.get', [$cat-4, $id_categorian1->slug])  );
   $breadcrumbs->push(ucfirst($id_categorian2->nombrecategoria), route('categoria.get', [$cat-3, $id_categorian2->slug])  );
      $breadcrumbs->push(ucfirst($id_categorian3->nombrecategoria), route('categoria.get', [$cat-2, $id_categorian3->slug])  );
        $breadcrumbs->push(ucfirst($category->nombrecategoria), route('categoria.get', [$cat-1, $id_categorian4])  );
    }

if ($cat=='search') {
    $breadcrumbs->push(('Búsqueda'), route('categoria.get', [$cat, $id])  );
}else{

    $breadcrumbs->push(removeCaps( $actual->nombrecategoria), route('categoria.get', [$cat, $id])  );
}




});


//productos


Breadcrumbs::register('product.show', function($breadcrumbs, $id)
{

  $product=Productomodelo::where('slug', $id)->first();   

  $breadcrumbs->parent('store.index');
  
  $breadcrumbs->push(  ucfirst($product->hasOneCategory1->nombrecategoria),  route('categoria.get', [1, $product->hasOneCategory1->slug])  );
  if ($product->id_categorian2) {
  $breadcrumbs->push(  ucfirst($product->hasOneCategory2->nombrecategoria),  route('categoria.get', [2, $product->hasOneCategory2->slug])  );
  }
  if ($product->id_categorian3) {
   $breadcrumbs->push(  ucfirst($product->hasOneCategory3->nombrecategoria),  route('categoria.get', [3, $product->hasOneCategory3->slug])  );
 }
     if ($product->id_categorian4) {
   $breadcrumbs->push(  ucfirst($product->hasOneCategory4->nombrecategoria),  route('categoria.get', [4, $product->hasOneCategory4->slug])  );
 }
     if ($product->id_categorian5) {
    $breadcrumbs->push(  ucfirst($product->hasOneCategory5->nombrecategoria),  route('categoria.get', [5, $product->hasOneCategory5->slug]) );
  }

  $breadcrumbs->push(  ucfirst($product->nombre_producto),  route('product.show', [$id, $product->referencia])  );
});
