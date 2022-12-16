<?php

namespace App\Http\Controllers;

use App\Productomodelo;
use Illuminate\Http\Request;

class RssFeedController extends Controller
{
    public function generate_rss_feed()
    {
        $products = Productomodelo::
        with('hasManyImagenes')
        ->has('hasManyImagenes')
        ->orderBy('id', 'desc')
                    ->get();
          
        return response()->view('layouts.feed', 
        compact('products'))
        ->header('Content-Type', 'application/xml');

    }
}
