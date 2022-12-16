<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
    {{--}}    
    <title><![CDATA[ codecheef ]]></title>
        <link><![CDATA[ {{url('/') .'feed'}} ]]></link>
        <description><![CDATA[ A Nice Description Of Your Website! ]]></description>
        <language>en</language>
        <pubDate>{{ now()->toDayDateTimeString('Asia/Dhaka') }}</pubDate>
--}}
        @foreach($products as $data)
            <item>
                <title><![CDATA[{{ $data->nombre_producto }}]]></title>
                <link>{{route('product.show', $data->slug) }}</link>
                <description><![CDATA[{!!  ucfirst( strtolower($data->descripcion ?? 'No description'))  !!}]]></description>
                <category>{{ $data->createt_at }}</category>
                <author><![CDATA[{{ $nombre_tienda  }}]]></author>
                <brand>{{$data->getMarcaProduct($data->id)['nombre'] ?? ''}}</brand>
                <guid>{{ $data->slug }}</guid>
                <gtin>{{ $data->codigobarras }}</gtin>
                <id>{{ $data->id }}</gtin>
                <pubDate>{{ $data->created_at}}</pubDate>
                <condition>{{ $data->nuevo_usado == true ? 'new'  : 'used'}}</condition>
                <availability>{{ $data->cantidad >0 && $data->estado == true ? 'In stock'  : 'Out of stock'}}</availability>
                <image_link>{{'https://'.$data->hasManyImagenes->first()->urlimagen}}</image_link>
                <price>{{ number_format((float) precioNew($data->slug)) }}</price>
                <google_product_category>{{$data->getMarcaProduct($data->id)['nombre']}}</google_product_category>
            </item>
        @endforeach
    </channel>
</rss>