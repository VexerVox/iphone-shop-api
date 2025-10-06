<?php

use App\Domains\Common\Http\Middleware\ForceJsonResponseMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(ForceJsonResponseMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        if (DB::transactionLevel() > 0) {
            DB::rollBack();
        }

        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'success' => false,
            ], 404);
        });

        if (app()->environment('production')) {
            $exceptions->render(function (Throwable $e) {
                return response()->json([
                    'success' => false,
                ], 500);
            });
        }
    })->create();
