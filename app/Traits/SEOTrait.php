<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use App\SEO;
use Illuminate\Support\Str;

trait SEOTrait {



  public function setSEOManager()
  {
   try{
    $data = SEO::first();

    $title=$data->title;
    $description =  Str::limit($data->description , 140 , '...');
    $url =$data->url;
    $logo = $data->logo;
    $hashtag = $data->hashtag;
    $keywords = $data->keywords;

    SEOMeta::setTitle($title, false);
    //SEOMeta::titleBefore($description);
    SEOMeta::setDescription($description);
    SEOMeta::setCanonical($url);
    SEOMeta::addKeyword([$keywords]);

    OpenGraph::setDescription($description);
    OpenGraph::setTitle($title);
    OpenGraph::setUrl($url);//slug
    OpenGraph::addProperty('type', 'articles');
    OpenGraph::addImage($logo);
    OpenGraph::addImage(['url' => $logo, 'size' => 300]);
    OpenGraph::addImage($logo, ['height' => 300, 'width' => 300]);
    OpenGraph::addImage($logo, ['height' => 600, 'width' => 600]);

    TwitterCard::setTitle($title);
    TwitterCard::setSite($hashtag);
    TwitterCard::setDescription($description); // description of twitter card tag
    TwitterCard::setUrl($url); // url of twitter card tag
    TwitterCard::setImage($logo); // add image url

    //JsonLd::addImage($logo);
    JsonLd::setTitle($title); // title of twitter card tag
    JsonLd::setSite($url); // site of twitter card tag
    JsonLd::setDescription($description); // description of twitter card tag
    JsonLd::setUrl($url); // url of twitter card tag
    JsonLd::setImage($logo); // add image url



    JsonLdMulti::setTitle($title);
    JsonLdMulti::setDescription($description);
    JsonLdMulti::setType('WebPage');
    JsonLdMulti::addImage($logo);
    if(! JsonLdMulti::isEmpty()) {
        JsonLdMulti::newJsonLd();
        JsonLdMulti::setType('WebPage');
        JsonLdMulti::setTitle('Page Article - '.$title);
    }

   }catch(\Exception $e){

   }




    //return true;
  }


    public function setSEOManagerShow($product, $filters, $allImages)
  {
    $data = SEO::first();

    $title=$product->nombre_producto;
    $description = Str::limit($product->descripcion , 140 , '...');
    $url =$data->url . $product->slug ;
    $logo = $allImages[0]['urlimagen'];
    $hashtag = $data->hashtag;
    $keywords = $data->keywords;


    SEOMeta::setTitle($title, false);
    SEOMeta::setDescription($description);
    //SEOMeta::titleBefore($description);
    //SEOMeta::addMeta('article:published_time', $product->created_at->toW3CString(), 'property');
    SEOMeta::addMeta('product:published_time', $product->created_at, 'property');
    SEOMeta::addMeta('product:section', $product->id_categorian1, 'property');
    SEOMeta::setCanonical($url);
    SEOMeta::addKeyword([$keywords]);

    OpenGraph::setDescription($description);
    OpenGraph::setTitle($title);
    OpenGraph::setUrl($url);//slug
    OpenGraph::addProperty('type', 'product');
    OpenGraph::addProperty('locale', 'es-CO');
    OpenGraph::addProperty('locale:alternate', ['es-Co', 'en-us', 'es-MX']);

    OpenGraph::addImage($logo);
    OpenGraph::addImage(['url' => $logo, 'size' => 300]);
    OpenGraph::addImage($logo, ['height' => 300, 'width' => 300]);
    OpenGraph::addImage($logo, ['height' => 600, 'width' => 600]);


    //JsonLd::addImage($logo);
    JsonLd::setTitle($title); // title of twitter card tag
    JsonLd::setDescription($description); // description of twitter card tag
    JsonLd::setType('Product');
    JsonLd::addImage($logo); // add image url



    JsonLdMulti::setTitle($title);
    JsonLdMulti::setDescription($description);
    JsonLdMulti::setType('Product');
    JsonLdMulti::addImage($logo);
    if(! JsonLdMulti::isEmpty()) {
        JsonLdMulti::newJsonLd();
        JsonLdMulti::setType('WebPage');
        JsonLdMulti::setTitle('Page Article - '.$title);
    }


    TwitterCard::setTitle($title);
    TwitterCard::setSite($hashtag);
    TwitterCard::setDescription($description); // description of twitter card tag
    TwitterCard::setUrl($url); // url of twitter card tag
    TwitterCard::setImage($logo); // add image url

        // article
        OpenGraph::setTitle($title.'acatest')
            ->setDescription($description)
            ->setType('product')
            ->setArticle([
                'published_time' => $product->created_at,
                'modified_time' => $product->updated_at,
                'expiration_time' =>  $product->created_at,
                'author' => $product->slug,
                'section' => $product->id_categorian1,
                'tag' => $keywords
            ]);


    //return true;
  }



}
