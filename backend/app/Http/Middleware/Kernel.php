protected $routeMiddleware = [
    // Middleware bawaan Laravel
    'auth' => \App\Http\Middleware\Authenticate::class,
    // Middleware kustom
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    // Middleware lainnya...
];
