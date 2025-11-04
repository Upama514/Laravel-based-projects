<?php

return [
    'paths' => ['api/*', 'sanctum/csfr-cookie', 'login', 'logout', 'register'],
    
    'allowed_methods' => ['*'],
    
    'allowed_origins' => [
        'http://localhost:9000',
        'http://127.0.0.1:9000', 
        'http://localhost:9002',
        'http://127.0.0.1:9002',
        'http://localhost:9007',
        'http://127.0.0.1:9007'
    ],
    
    'allowed_origins_patterns' => [],
    
    'allowed_headers' => ['*'],
    
    'exposed_headers' => [],
    
    'max_age' => 0,
    
    'supports_credentials' => true,
];