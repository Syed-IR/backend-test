<?php

return [

    'newsapi' => [
        'url' => 'https://newsapi.org/v2/everything',
        'api_key' => env('NEWS_API_KEY'),
        'api_key_param' => 'apiKey',
        'from_param' => 'from',
        'to_param' => 'to',
        'request_limit' => 1000,
    ],
   
    'guardian' => [
        'url' => 'https://content.guardianapis.com/search',
        'api_key' => env('GUARDIAN_API_KEY'),
        'api_key_param' => 'api-key',
        'from_param' => 'from-date',
        'to_param' => 'to-date',
        'request_limit' => 500,
    ],
   
    'nyt' => [
        'url' => 'https://api.nytimes.com/svc/search/v2/articlesearch.json',
        'api_key' => env('NYT_API_KEY'),
        'api_key_param' => 'api-key',
        'from_param' => 'begin_date',
        'to_param' => 'end_date',
        'request_limit' => 500,
    ],
    
];
