<?php

namespace App\Http\Controllers;

use App\Models\Alcalde;
use App\Models\Footer;
use App\Models\Logo;
use Illuminate\Http\Request;
use Inertia\Inertia;


class AlcaldeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Administrador/Alcalde/Index", [
            'alcaldes' => Alcalde::all(),

        ]);
    }

    public function informacion(){
        return Inertia::render("Welcome/Alcalde/Index", [
            'alcaldes' => Alcalde::latest()->first(),
            'logos' => Logo::all(),
            'footers'=>Footer::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_alcalde' => ['required', 'max:50'],
            'content_alcalde' => ['required', 'string'], // Agregado para permitir grandes cantidades de texto
            'image_alcalde' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);
    
        $imageName = $request->file('image_alcalde')->getClientOriginalName(); // Obtiene el nombre original del archivo
    
        $request->file('image_alcalde')->storeAs('imagenalcaldes', $imageName, 'public'); // Guarda la imagen con su nombre original
    
        Alcalde::create([
            'name_alcalde' => $request->input('name_alcalde'),
            'content_alcalde' => $request->input('content_alcalde'),
            'image_alcalde' => 'imagenalcaldes/' . $imageName, // Guarda en la base de datos el nombre del archivo
        ]);
    
        return redirect()->route('alcalde.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alcalde $alcalde)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alcalde $alcalde)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alcalde $alcalde)
    {
        try {
            // Verificar si se está actualizando también la imagen
            if ($request->hasFile('image_alcalde')) {
                $request->validate([
                    'name_alcalde' => ['required', 'max:50'],
                    'content_alcalde' => ['required', 'string'],
                    'image_alcalde' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    // Validar la imagen si está presente
                ]);
    
                $image = $request->file('image_alcalde');
                $imageName = $image->getClientOriginalName(); // Obtener el nombre original
    
                $imagePath = $image->storeAs('imagenalcaldes', $imageName, 'public'); // Guardar con su nombre original
    
                // Actualizar la ruta de la nueva imagen en la base de datos
                $alcalde->image_alcalde = 'imagenalcaldes/' . $imageName;
            } else {
                // Si no se actualiza la imagen, validar solo el título y el contenido de la noticia
                $request->validate([
                    'name_alcalde' => ['required', 'max:50'],
                    'content_alcalde' => ['required', 'string'],
                ]);
            }
    
            $alcalde->name_alcalde = $request->input('name_alcalde');
            $alcalde->content_alcalde = $request->input('content_alcalde');
    
            $alcalde->save();
            return redirect()->route('alcalde.index');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la noticia de prensa'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alcalde $alcalde)
    {
        $alcalde->delete();
        return to_route('alcalde.index');
    }
}
