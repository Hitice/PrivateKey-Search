<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrawlerResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'regex_match',
        'found_at',
    ];

    // Se precisar de lógica adicional, pode ser adicionada aqui
}
