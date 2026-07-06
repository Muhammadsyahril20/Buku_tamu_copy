<?php

// 1. Paksa Laravel menggunakan folder /tmp Vercel untuk semua proses cache dan view
$vercelTmpPaths = [
    'VIEW_COMPILED_PATH' => '/tmp',
    'APP_CONFIG_CACHE' => '/tmp/config.php',
    'APP_EVENTS_CACHE' => '/tmp/events.php',
    'APP_PACKAGES_CACHE' => '/tmp/packages.php',
    'APP_ROUTES_CACHE' => '/tmp/routes-v7.php',
    'APP_SERVICES_CACHE' => '/tmp/services.php',
    'LOG_CHANNEL' => 'stderr',
];

// 2. Suntikkan paksa ke dalam sistem PHP
foreach ($vercelTmpPaths as $key => $value) {
    putenv("{$key}={$value}");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

// 3. Panggil sistem utama Laravel
require __DIR__ . '/../public/index.php';