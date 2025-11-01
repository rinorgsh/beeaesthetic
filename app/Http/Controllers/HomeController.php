<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Home', [
            'title' => 'Bienvenue sur votre site',
        ]);
    }

    /**
     * Affiche la page des services
     * ✅ RENOMMÉ : manicure() → services()
     *
     * @return \Inertia\Response
     */
    public function services()
    {
        return Inertia::render('Services', [
            // Vous pouvez ajouter des données ici
        ]);
    }

    public function formation()
    {
        return Inertia::render('Formation', [
            
        ]);
    }

    public function reviews()
    {
        return Inertia::render('Reviews', [
            
        ]);
    }

    public function about()
    {
        return Inertia::render('About', [
            
        ]);
    }

    public function contact()
    {
        return Inertia::render('Contact', [
            
        ]);
    }

    public function rdv()
    {
        return Inertia::render('Rdv', [
            
        ]);
    }

    public function gallerie()
    {
        return Inertia::render('Gallerie', [
            
        ]);
    }
}