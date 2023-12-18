<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use Inertia\Inertia;


class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Administrador/Footer/Index", [
            'footers' => Footer::all(),

        ]);
    }


    //Vista para el cliente

    public function viewuser()
    {
        $footers=Footer::latest()->first();
        return Inertia::render("Welcome/Footer/Index", [
            //'footers' => Footer::all(),
            //'footers'=>Footer::latest()->first(),
            'footers'=>$footers

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
            'gestion_footer' => ['required', 'string'], 
            'copy_footer' => ['required', 'string'], 
            'image_footer' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
            'telefono_footer' => ['required', 'max:50'],
            'link_footer' => ['required', 'max:50'],

        ]);
    
        $imageName = $request->file('image_footer')->getClientOriginalName(); // Obtiene el nombre original del archivo
    
        $request->file('image_footer')->storeAs('imagenfooter', $imageName, 'public'); // Guarda la imagen con su nombre original
    
        Footer::create([
            'gestion_footer' => $request->input('gestion_footer'),
            'copy_footer' => $request->input('copy_footer'),
            'image_footer' => 'imagenfooter/' . $imageName, // Guarda en la base de datos el nombre del archivo
            'telefono_footer' => $request->input('telefono_footer'),
            'link_footer' => $request->input('link_footer'),

        ]);
    
        return redirect()->route('footers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Footer $footer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Footer $footer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Footer $footer)
    {
        try {
            // Verificar si se está actualizando también la imagen
            if ($request->hasFile('image_footer')) {
                $request->validate([
                    'gestion_footer' => ['required', 'string'], 
                    'copy_footer' => ['required', 'string'], 
                    'image_footer' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
                    'telefono_footer' => ['required', 'max:50'],
                    'link_footer' => ['required', 'max:50'],
                ]);
    
                $image = $request->file('image_footer');
                $imageName = $image->getClientOriginalName(); // Obtener el nombre original
    
                $imagePath = $image->storeAs('imagenfooter', $imageName, 'public'); // Guardar con su nombre original
    
                // Actualizar la ruta de la nueva imagen en la base de datos
                $footer->image_footer = 'imagenfooter/' . $imageName;
            } else {
                // Si no se actualiza la imagen, validar solo el título y el contenido de la noticia
                $request->validate([
                    'gestion_footer' => ['required', 'string'], 
                    'copy_footer' => ['required', 'string'], 
                    'telefono_footer' => ['required', 'max:50'],
                    'link_footer' => ['required', 'max:50'],
                ]);
            }
    
            $footer->gestion_footer = $request->input('gestion_footer');
            $footer->copy_footer = $request->input('copy_footer');
            $footer->telefono_footer = $request->input('telefono_footer');
            $footer->link_footer = $request->input('link_footer');

    
            $footer->save();
            return redirect()->route('footers.index');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la noticia de prensa'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Footer $footer)
    {
        $footer->delete();
        return to_route('footers.index');
    }
}