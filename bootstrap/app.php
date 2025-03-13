<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Inertia\Inertia;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\ForceHttps::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('/*') && $e instanceof NotFoundHttpException) {
                return Inertia::render('Error', [
                    'statusCode' => 404,
                    'title' => 'Page Introuvable',
                    'description' => 'La page que vous recherchez n\'existe pas ou a été déplacée.'
                ]);
            }
    
            // Vous pouvez ajouter d'autres types d'erreurs ici
            if ($e instanceof HttpException) {
                return Inertia::render('Error', [
                    'statusCode' => $e->getStatusCode(),
                    'title' => match($e->getStatusCode()) {
                        403 => 'Accès Refusé',
                        500 => 'Erreur Serveur',
                        503 => 'Service Indisponible',
                        default => 'Erreur Inattendue'
                    },
                    'description' => match($e->getStatusCode()) {
                        403 => 'Vous n\'avez pas la permission d\'accéder à cette page.',
                        500 => 'Un problème est survenu sur notre serveur.',
                        503 => 'Le site est temporairement indisponible.',
                        default => 'Une erreur inattendue s\'est produite.'
                    }
                ]);
            }
        });
    })->create();
