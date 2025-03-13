<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        $response = parent::render($request, $exception);

        if ($request->is('/*') && in_array($response->getStatusCode(), [404, 403, 500, 503])) {
            return Inertia::render('Error', [
                'statusCode' => $response->getStatusCode(),
                'title' => match($response->getStatusCode()) {
                    404 => 'Page Introuvable',
                    403 => 'Accès Refusé',
                    500 => 'Erreur Serveur',
                    503 => 'Service Indisponible',
                    default => 'Erreur Inattendue'
                },
                'description' => match($response->getStatusCode()) {
                    404 => 'La page que vous recherchez n\'existe pas ou a été déplacée.',
                    403 => 'Vous n\'avez pas la permission d\'accéder à cette page.',
                    500 => 'Un problème est survenu sur notre serveur.',
                    503 => 'Le site est temporairement indisponible.',
                    default => 'Une erreur inattendue s\'est produite.'
                }
            ])->toResponse($request);
        }

        return $response;
    }
}