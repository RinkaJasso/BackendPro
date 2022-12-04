<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'apellido',
        'rol',
        'email',
        'password',
        'image'
    ];
    use HasFactory;

    public function Entradas(){
        return $this->hasMany(Entrada::class, 'id_usuario', 'id');
    }
}
