<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // es llamado de migrations(down)

    protected $fillable = [ //fillable = campos que podran ser adaptados
        'name',
        'description',
        'price',
        'stock',
        'state', // Incluir 'state' en los campos asignables en masa
    ];

    protected $attributes = [
        'state' => 1, // Valor predeterminado para el campo 'state'
    ];
}
