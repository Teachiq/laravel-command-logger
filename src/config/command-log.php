<?php

return [
    'channel' => [
        'driver' => 'single',
        'path' => storage_path('logs/command.log'),
        'level' => 'debug',
    ],
    'exclude' => [
        'config:cache',
        'route:cache',
    ],
    'slow' => 5,
];
