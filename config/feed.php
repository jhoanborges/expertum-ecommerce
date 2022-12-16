<?php

return [

'feeds' => [
    'news' => [
        /*
         * Here you can specify which class and method will return
         * the items that should appear in the feed. For example:
         * 'App\Model@getAllFeedItems'
         * or
         * ['App\Model', 'getAllFeedItems']
         *
         * You can also pass an argument to that method.  Note that their key must be the name of the parameter:             * 
         * ['App\Model@getAllFeedItems', 'parameterName' => 'argument']
         * or
         * ['App\Model', 'getAllFeedItems', 'parameterName' => 'argument']
         */
        'items' => 'App\Productomodelo@getFeedItems',

        /*
         * The feed will be available on this url.
         */
        'url' => '/feed',

        'title' => 'All newsitems on mysite.com',

        /*
         * The format of the feed.  Acceptable values are 'rss', 'atom', or 'json'.
         */
        'format' => 'atom',

        /*
         * Custom view for the items.
         *
         * Defaults to feed::feed if not present.
         */
        'view' => 'feed::feed',
    ],
],

];