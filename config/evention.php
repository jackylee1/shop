<?php

return [
    /*
     * Temporary User Config
     */
    'temporary_user' => [
        /*
         * Temporary User Cookie Name
         */
        'cookie' => env('TEMPORARY_USER_COOKIE',
            str_slug(env('APP_NAME', 'evention'), '_').'_tu'
        ),
    ],
];