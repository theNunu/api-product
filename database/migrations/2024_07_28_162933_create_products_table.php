<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Campo 'id' que es la clave primaria autoincremental
            $table->string('name');  // Campo 'name' para el nombre del producto
            $table->text('description')->nullable(); // Campo 'description' para la descripción del producto, puede ser nulo
            $table->decimal('price', 8, 2);  // Campo 'price' para el precio del producto, con 8 dígitos en total y 2 decimales
            $table->integer('stock'); // Campo 'stock' para la cantidad de productos en inventario
            $table->timestamps(); // Campos 'created_at' y 'updated_at' generados automáticamente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // el products se toma de referencia en models(Product.php)
    }
};
