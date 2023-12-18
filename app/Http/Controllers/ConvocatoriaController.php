<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ConvocatoriaFecha;
use App\Models\Convocatoria;
use App\Models\Logo;
use App\Models\Footer;





class ConvocatoriaController extends Controller
{
    public function index()
    {
        $convocatorias = Convocatoria::with('convocatoriaFecha.convocatorias')->latest()->get()->groupBy('convocatoriaFecha.title_convocatoria');
        $convocatoriasfechas = ConvocatoriaFecha::select('id', 'title_convocatoria', 'fecha_limite')
        ->where('activo', true)
        ->get();
        $listas=Convocatoria::all();
        return Inertia::render('Administrador/Convocatoria/Index', [
            'convocatorias' => $convocatorias,
            'convocatoriasfechas' => $convocatoriasfechas,
        ]);
    }
    
    

   /* public function index()
    {

        $convocatorias = Convocatoria::with('convocatoriaFecha')->latest()->get()->pluck('convocatoriaFecha');


        $convocatoriasfechas = ConvocatoriaFecha::select('id', 'title_convocatoria', 'fecha_limite')
            ->where('activo', true)
            ->get();

            return Inertia::render('Administrador/Convocatoria/Index', [
            'convocatorias' => $convocatorias,
            'convocatoriasfechas' => $convocatoriasfechas,
        ]);
    }*/

//vsita cliente
public function viewconvocatoria()
{
    $listas = Convocatoria::with('convocatoriaFecha.convocatorias')
        ->latest()
        ->orderByDesc('created_at')
        ->get();
    // Organizar las convocatorias por fecha y título
    $groupedConvocatorias = $listas->groupBy(function ($convocatoria) {
        return [
            //'date' => $convocatoria->created_at->format('Y-m-d'), // Agrupa por día
            'title' => $convocatoria->convocatoriaFecha->title_convocatoria,
        ];
    });
   // $logos = Logo::all();


    return Inertia::render('Welcome/Convocatoria/Index', [
        'listas' => $groupedConvocatorias,
        'logos' => Logo::all(),
        'footers'=>Footer::all(),

    ]);
}





            //'listas' => Convocatoria::orderBy('created_at', 'desc')->get(),








    public function store(Request $request)
    {
        $request->validate([
            'content_convocatoria' => ['required'],
            'convocatoria_fecha_id' => ['required'],
        ]);
    
        Convocatoria::create([
            'content_convocatoria' => $request->input('content_convocatoria'),
            'convocatoria_fecha_id' => $request->input('convocatoria_fecha_id'),
        ]);
    
        return redirect()->route('convocatorias.index');
    }
    
}
