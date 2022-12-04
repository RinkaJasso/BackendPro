<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
    use HasFactory;

    public function Entradas(){
        return $this->hasMany(Entrada::class, 'id_categoria', 'id');
    }
}
