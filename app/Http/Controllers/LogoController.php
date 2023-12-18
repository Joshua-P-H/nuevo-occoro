<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Footer;
use Illuminate\Http\Request;
use Inertia\Inertia;


class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Administrador/Logo/Index", [
            'logos' => Logo::all(),

        ]);
    }

    public function logoview(){
        return Inertia::render("Welcome/Logo/Index", [
            //'logos' => Logo::all(),
            'logos' => Logo::latest()->take(1)->get(),

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
            'name_logo' => ['required', 'max:50'],
            'image_logo' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);
    
        $imageName = $request->file('image_logo')->getClientOriginalName(); // Obtiene el nombre original del archivo
    
        $request->file('image_logo')->storeAs('imagenlogo', $imageName, 'public'); // Guarda la imagen con su nombre original
    
        Logo::create([
            'name_logo' => $request->input('name_logo'),
            'image_logo' => 'imagenlogo/' . $imageName, // Guarda en la base de datos el nombre del archivo
        ]);
    
        return redirect()->route('logos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logo $logo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logo $logo)
    {
        try {
            // Verificar si se está actualizando también la imagen
            if ($request->hasFile('image_logo')) {
                $request->validate([
                    'name_logo' => ['required', 'max:50'],
                    'image_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    // Validar la imagen si está presente
                ]);
    
                $image = $request->file('image_logo');
                $imageName = $image->getClientOriginalName(); // Obtener el nombre original
    
                $imagePath = $image->storeAs('imagenlogo', $imageName, 'public'); // Guardar con su nombre original
    
                // Actualizar la ruta de la nueva imagen en la base de datos
                $logo->image_logo = 'imagenlogo/' . $imageName;
            } else {
                // Si no se actualiza la imagen, validar solo el título y el contenido de la noticia
                $request->validate([
                    'name_logo' => ['required', 'max:50'],
                ]);
            }
    
            $logo->name_logo = $request->input('name_logo');
    
            $logo->save();
            return redirect()->route('logos.index');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la noticia de prensa'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logo $logo)
    {
        $logo->delete();
        return to_route('logos.index');
    }
}
