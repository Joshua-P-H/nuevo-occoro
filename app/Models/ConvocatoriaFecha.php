<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class ConvocatoriaFecha extends Model
{
    use HasFactory;
   /* protected $fillable = ['title_convocatoria', 'activo','fecha_limite','fecha_fin'];

    public function convocatoria(){
        return $this->hasMany(Convocatoria::class);

    }*/
    protected $fillable = ['title_convocatoria', 'fecha_limite', 'fecha_fin'];
    protected $attributes = [
        'activo' => true,
    ];
    public static function boot()
    {
        parent::boot();

        static::saving(function ($convocatoriaFecha) {
            // Antes de guardar, establecemos "activo" en false para todos los registros
            DB::table($convocatoriaFecha->getTable())->update(['activo' => false]);

            // Luego, establecemos "activo" en true solo para el registro que se está guardando
            $convocatoriaFecha->activo = true;
        });
    }


    public function convocatorias()
    {
        return $this->hasMany(Convocatoria::class,);
    }

}
