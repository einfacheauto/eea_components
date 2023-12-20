<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'EEA Components',
    'description' => 'Adds Einfach E-Auto components to your application. Requires an active subscription.',
    'category' => 'plugin',
    'author' => 'Tashko Valkov',
    'author_email' => 'softtechwebseo@gmail.com',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'version' => '11.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
