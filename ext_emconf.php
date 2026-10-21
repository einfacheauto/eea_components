<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'EEA Components',
    'description' => 'Adds Einfach E-Auto components to your application. Requires an active subscription.',
    'category' => 'plugin',
    'author' => 'Tashko Valkov',
    'author_email' => 'softtechwebseo@gmail.com',
    'state' => 'stable',
    'version' => '13.1.0', // x-release-please-version
    'constraints' => [
        'depends' => [
            'php' => '8.2.0-8.4.99',
            'typo3' => '13.4.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
