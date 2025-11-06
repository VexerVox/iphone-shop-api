<?php

use App\Domains\Common\Http\Middleware\ForceJsonResponseMiddleware;
use App\Providers\RateLimitServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withProviders([
        RateLimitServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(ForceJsonResponseMiddleware::class);
    })
    ->withEvents(discover: array_map(
        fn ($path) => $path.'/Listeners',
        glob(__DIR__.'/../app/Domains/*', GLOB_ONLYDIR)
    ))
    ->withExceptions(function (Exceptions $exceptions): void {
        if (DB::transactionLevel() > 0) {
            DB::rollBack();
        }

        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Not Found',
            ], 404);
        });

        $exceptions->render(function (ThrottleRequestsException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Too many attempts',
            ], 429);
        });

        if (app()->environment('production')) {
            $exceptions->render(function (Throwable $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Server error',
                ], 500);
            });
        }
    })->create();
