<?php

return [

    'newsapi' => [
        'url' => 'https://newsapi.org/v2/everything',
        'api_key' => env('NEWS_API_KEY'),
        'has_pagination' => false,
        'request_limit' => 1000,
        'param_name' => [
            'api_key' => 'apiKey',
            'from' => 'from',
            'to' => 'to',
        ]
    ],
   
    'guardian' => [
        'url' => 'https://content.guardianapis.com/search',
        'api_key' => env('GUARDIAN_API_KEY'),
        'pageSize' => 200,
        'has_pagination' => true,
        'request_limit' => 500,
        'param_name' => [
            'api_key' => 'api-key',
            'from' => 'from-date',
            'to' => 'to-date',
            'pageSize' => 'page-size',
        ]
    ],
   
    'nyt' => [
        'url' => 'https://api.nytimes.com/svc/search/v2/articlesearch.json',
        'api_key' => env('NYT_API_KEY'),
        'has_pagination' => false,
        'request_limit' => 500,
        'param_name' => [
            'api_key' => 'api-key',
            'from' => 'begin_date',
            'to' => 'end_date',
        ]
    ],
    
];
