<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoConsultas extends Model
{
    use HasFactory;
    protected $table = 'historico_consultas';
    protected $primaryKey = 'id';

    public function historicoCiudad()
    {
        return $this->belongsTo('App\Models\Paises', 'idCiudad');
    }
}
