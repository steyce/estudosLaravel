<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lancamento extends Model
{
    use HasFactory;
    protected $fillable = ['categoria_id', 'descricao', 'valor', 'data'];
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
