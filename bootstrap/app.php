
<?php
use Illuminate\Foundation\Application;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Middleware\TrustProxies;

use App\Http\Middleware\SuperAdminMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   ->withMiddleware(function (Middleware $middleware): void {

    $middleware->trustProxies(at: '*');

    $middleware->alias([
        'adminMiddleware' => AdminMiddleware::class,
        'userMiddleware' => UserMiddleware::class,
        'superAdminMiddleware' => SuperAdminMiddleware::class,
    ]);

})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
