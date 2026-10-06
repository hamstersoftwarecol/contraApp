<?php
use Illuminate\Support\Facades\Artisan;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Inicializar la app
$kernel->bootstrap();

echo "<h2>Ejecutando comandos Artisan vía Kernel</h2>";
echo "<pre>";

Artisan::call('config:cache');
echo Artisan::output();

Artisan::call('route:cache');
echo Artisan::output();

Artisan::call('view:cache');
echo Artisan::output();

echo "</pre>";
