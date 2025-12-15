<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
try {
    $rows = Illuminate\Support\Facades\DB::select('SHOW COLUMNS FROM sessions');
    print_r($rows);
} catch (Exception $e) {
    echo "Error: ".$e->getMessage()."\n";
}
