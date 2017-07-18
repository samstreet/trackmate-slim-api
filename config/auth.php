<?php
/**
 * @author Sam Street
 */

return [
    'guards' => [
        'api' => [
            'driver' => 'passport', // was previously 'token'
            'provider' => 'users'
        ]
    ]
];