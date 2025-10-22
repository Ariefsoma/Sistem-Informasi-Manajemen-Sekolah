<?php
// Small script to fix a user's role by email. Run like: php scripts/fix_roles.php admin@example.com admin
if ($argc < 3) {
    echo "Usage: php scripts/fix_roles.php <email> <role>\n";
    exit(1);
}
$email = $argv[1];
$role = $argv[2];

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email', $email)->first();
if (! $user) {
    echo "User not found: $email\n";
    exit(1);
}
$user->role = $role;
$user->save();

echo "Updated $email => $role\n";
