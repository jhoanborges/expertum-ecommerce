<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;

use Response;

class AjaxController extends Controller
{


    public function index()
    {
        $countries = DB::table("categories")->where('parent_id' , $id)->lists("name","id");

        return view('index',compact('countries'));
    }
    public function getCategoria2List(Request $request)
    {
    	$belongsto= $request->id;
   
$states = Category::with('products')
        ->where('parent_id' , $request->id)
                //    ->where("country_id",$request->country_id)
                    ->pluck("name","id");
       return response()->json($states);
//Response::json(array('region'=>$region, 'id'=>$id));
    }
    public function getCategoria3List(Request $request)
    {
     $cities = Category::with('products')
        ->where('parent_id' , $request->id)
                    ->pluck("name","id");
        return response()->json($cities);
    }
}
