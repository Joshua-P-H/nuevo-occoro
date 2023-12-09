<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ConvocatoriaFecha;



class ConvocatoriaFechaController extends Controller
{
    public function index(){

    // Obtén todos los registros de ConvocatoriaFecha desde la base de datos
    $convocatoriasFechas = ConvocatoriaFecha::all();

    // Pasa los datos a la vista usando Inertia
    return Inertia::render('Administrador/Fecha/Index', [
        'convocatoriasFechas' => $convocatoriasFechas,
    ]);

    } 
    public function store(Request $request)
    {
        $request->validate([
            'title_convocatoria' => ['required', 'max:50'],
            'fecha_limite' => ['required', 'date'],
            'fecha_fin' => ['required', 'date'],
        ]);
    
        ConvocatoriaFecha::create([
            'title_convocatoria' => $request->input('title_convocatoria'),
            'activo' => $request->input('activo', true), // Por defecto a true si no se proporciona
            'fecha_limite' => $request->input('fecha_limite'),
            'fecha_fin' => $request->input('fecha_fin'),
        ]);
    
        return redirect()->route('fechas.index');
    }
    
    public function destroy(ConvocatoriaFecha $fecha)
    {
        $fecha->delete();
        return to_route('fechas.index');
    }
}
