<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller
{
    // Liste des produits
    public function index()
    {
        $products = Product::latest()->get();
        
        return Inertia::render('Admin/Products/Index', [
            'products' => $products
        ]);
    }

    // Formulaire de création
    public function create()
    {
        return Inertia::render('Admin/Products/Create');
    }

    

    // Formulaire d'édition
    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Edit', [
            'product' => $product
        ]);
    }

 

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:digital,physical',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:5120',
            'file' => 'nullable|file|max:102400',
        ]);
    
        // ✅ Upload de l'image en LOCAL (public)
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products/images', 'public');
            \Log::info('Image uploaded locally', ['path' => $validated['image']]);
        }
    
        // ✅ Upload du fichier sur S3 (privé)
        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('products/files', 's3');
            \Log::info('File uploaded to S3', ['path' => $validated['file_path']]);
        }
    
        // Génère le slug unique
        $slug = Str::slug($validated['name']);
        $count = 1;
        
        while (Product::where('slug', $slug)->exists()) {
            $slug = Str::slug($validated['name']) . '-' . $count;
            $count++;
        }
        
        $validated['slug'] = $slug;
    
        $product = Product::create($validated);
    
        return redirect()->route('admin.products.index')
            ->with('success', 'Produit créé avec succès !');
    }
    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:digital,physical',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:5120',
            'file' => 'nullable|file|max:102400',
        ]);
    
        // ✅ Upload de la nouvelle image en LOCAL
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products/images', 'public');
        }
    
        // ✅ Upload du nouveau fichier sur S3
        if ($request->hasFile('file')) {
            if ($product->file_path) {
                Storage::disk('s3')->delete($product->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('products/files', 's3');
        }
    
        // Met à jour le slug si le nom a changé
        if ($validated['name'] !== $product->name) {
            $slug = Str::slug($validated['name']);
            $count = 1;
            
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = Str::slug($validated['name']) . '-' . $count;
                $count++;
            }
            
            $validated['slug'] = $slug;
        }
    
        $product->update($validated);
    
        return redirect()->route('admin.products.index')
            ->with('success', 'Produit mis à jour avec succès !');
    }
    
    public function destroy(Product $product)
    {
        // ✅ Supprime l'image en local
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        // ✅ Supprime le fichier de S3
        if ($product->file_path) {
            Storage::disk('s3')->delete($product->file_path);
        }
    
        $product->delete();
    
        return redirect()->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès !');
    }
}