<?php

return [
    'encrypt_decrypt' => [
        "ENCRYPTION_SECRET_KEY" => env('ENCRYPTION_SECRET_KEY', "ox$(TQvxr*dok^UHKFhrrhwd1%g9vBQb"),
        "ENCRYPTION_IV" => env('ENCRYPTION_IV', "WqvbRGTtl*LRDGXh"),
        "ENCRYPTION_TYPE" => env('ENCRYPTION_TYPE', "aes-256-cbc"),
    ],
];
