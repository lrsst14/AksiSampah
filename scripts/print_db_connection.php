<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "APP_ENV=".config('app.env')."\n";
echo "APP_DEBUG=".(config('app.debug') ? 'true' : 'false')."\n";
echo "database.default=".config('database.default')."\n";
$default = config('database.default');
echo "database.driver=".config("database.connections.$default.driver")."\n";
echo "session.driver=".config('session.driver')."\n";
echo "session.connection=".(config('session.connection') ?? 'null')."\n";


echo "DB_URL=".env('DB_URL', env('DATABASE_URL', 'not set'))."\n";

return 0;
