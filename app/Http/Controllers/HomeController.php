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
            // Vous pouvez ajouter d'autres données ici
        ]);
    }
    public function manicure()
    {
        return Inertia::render('Manicure', [
            
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
}