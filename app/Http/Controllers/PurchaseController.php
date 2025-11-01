<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = auth()->user()
            ->purchases()
            ->with('product')
            ->latest()
            ->get();

        return Inertia::render('MyPurchases', [
            'purchases' => $purchases
        ]);
    }
}