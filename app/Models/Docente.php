<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'especialidad',
        'email',
        'telefono'
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
