<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$user = App\Models\User::first();
if (! $user) {
    echo "no user, creating test user...\n";
    $email = 'test@example.com';
    $password = Illuminate\Support\Facades\Hash::make('password123');
    Illuminate\Support\Facades\DB::table('users')->insert([
        'name' => 'Test User',
        'email' => $email,
        'password' => $password,
        'role' => 'warga',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $user = App\Models\User::where('email', $email)->first();
}
echo "getKeyName: " . $user->getKeyName() . "\n";
echo "casts: \n"; print_r($user->getCasts());
echo "attributes: \n"; print_r($user->getAttributes());

echo "Attempting Auth::attempt...\n";
$ok = Illuminate\Support\Facades\Auth::attempt(['email' => $user->email, 'password' => 'password123']);
echo "Auth::attempt returned: ".($ok? 'true' : 'false')."\n";
if ($ok) echo "User id after login (Auth::id): ".Illuminate\Support\Facades\Auth::id()."\n";

