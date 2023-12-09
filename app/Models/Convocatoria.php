<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
    use HasFactory;
    protected $fillable = ['content_convocatoria', 'convocatoria_fecha_id'];

    public function convocatoriaFecha()
    {
        return $this->belongsTo(ConvocatoriaFecha::class,'convocatoria_fecha_id');
    }
}
