<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller 
{
    public function submit(Request $request) 
    {
        $validatedData = $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        try {
            Mail::to('info@beeaesthetic.be')->send(new ContactFormMail($validatedData));
            
            return response()->json([
                'success' => true,
                'message' => 'Email envoyé avec succès'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'email',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}