<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->unique(); // ID de paiement Stripe/PayPal
            $table->decimal('amount', 10, 2);
            $table->integer('download_count')->default(0);
            $table->integer('max_downloads')->default(5); // Max 5 téléchargements
            $table->timestamp('expires_at')->nullable(); // Accès limité dans le temps (optionnel)
            $table->timestamps();
            
            // Un utilisateur ne peut acheter le même produit qu'une fois
            $table->unique(['user_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};