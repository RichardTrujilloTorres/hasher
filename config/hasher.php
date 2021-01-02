<?php

return [
    'salt' => [
        'sha512' => env('SHA512_SALT'),
        'sha256' => env('SHA256_SALT'),
        'md5' => env('MD5_SALT'),
        'sha1' => env('SHA1_SALT'),
    ],
];
