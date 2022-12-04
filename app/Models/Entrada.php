<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrada extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'content',
        'status',
        'image'
    ];
    use HasFactory;

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario','id');
    }
    public function categoria(){
        return $this->belongsTo(Categoria::class,'id_categoria','id');
    }
}
