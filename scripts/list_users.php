<?php
// Simple script to list users and their roles. Run from project root: php scripts/list_users.php
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap the framework
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = App\Models\User::all();
foreach ($users as $u) {
    echo $u->id . ' | ' . $u->email . ' => ' . ($u->role ?? 'NULL') . PHP_EOL;
}

echo "Done.\n";
