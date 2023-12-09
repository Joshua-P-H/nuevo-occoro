<?php

namespace App\Http\Controllers;

use App\Models\Prensa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DemografiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Welcome/Demografia/Index",[
            'prensas' => Prensa::all(),

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
            'title_prensa' => ['required', 'max:50'],
            'content_prensa' => ['required', 'string'], // Agregado para permitir grandes cantidades de texto
            'image_prensa' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);
    
        $imageName = $request->file('image_prensa')->getClientOriginalName(); // Obtiene el nombre original del archivo
    
        $request->file('image_prensa')->storeAs('imagesprensa', $imageName, 'public'); // Guarda la imagen con su nombre original
    
        Prensa::create([
            'title_prensa' => $request->input('title_prensa'),
            'content_prensa' => $request->input('content_prensa'),
            'image_prensa' => 'imagesprensa/' . $imageName, // Guarda en la base de datos el nombre del archivo
        ]);
    
        return redirect()->route('prensas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prensa = Prensa::find($id);

        // Asegúrate de que la variable $prensa no sea nula antes de acceder a sus propiedades
        if ($prensa) {
            $imagenUrl = url('imagesprensa/' . $prensa->imagen); // Construye la URL completa
        } else {
            $imagenUrl = null;
        }

        return Inertia::render('Show', ['prensa' => $prensa, 'imagenUrl' => $imagenUrl]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prensa $prensa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prensa $prensa)
    {
        try {
            // Verificar si se está actualizando también la imagen
            if ($request->hasFile('image_prensa')) {
                $request->validate([
                    'title_prensa' => ['required', 'max:50'],
                    'content_prensa' => ['required', 'string'],
                    'image_prensa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    // Validar la imagen si está presente
                ]);
    
                $image = $request->file('image_prensa');
                $imageName = $image->getClientOriginalName(); // Obtener el nombre original
    
                $imagePath = $image->storeAs('imagesprensa', $imageName, 'public'); // Guardar con su nombre original
    
                // Actualizar la ruta de la nueva imagen en la base de datos
                $prensa->image_prensa = 'imagesprensa/' . $imageName;
            } else {
                // Si no se actualiza la imagen, validar solo el título y el contenido de la noticia
                $request->validate([
                    'title_prensa' => ['required', 'max:50'],
                    'content_prensa' => ['required', 'string'],
                ]);
            }
    
            $prensa->title_prensa = $request->input('title_prensa');
            $prensa->content_prensa = $request->input('content_prensa');
    
            $prensa->save();
            return redirect()->route('prensas.index');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la noticia de prensa'], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prensa $prensa)
    {
        $prensa->delete();
        return to_route('prensas.index');
    }
}
