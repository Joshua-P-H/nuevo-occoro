<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Carrousel;


class CarrouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            return Inertia::render('Administrador/Carrousel/Index',[
                'carrouseles' => Carrousel::latest()->get(),

            ]);

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**imagescarrousel
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_carrousel' => ['required', 'max:50'],
            'image_carrousel' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        $imageName = $request->file('image_carrousel')->getClientOriginalName(); // Obtiene el nombre original del archivo

        $request->file('image_carrousel')->storeAs('imagescarrousel', $imageName, 'public'); // Guarda la imagen con su nombre original

        Carrousel::create([
            'name_carrousel' => $request->input('name_carrousel'),
            'image_carrousel' => 'imagescarrousel/' . $imageName, // Guarda en la base de datos el nombre del archivo

        ]);

        return redirect()->route('carrousel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrousel $carrousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrousel $carrousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrousel $carrousel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrousel $carrousel)
    {
        $carrousel->delete();
        return to_route('carrousel.index');
    }
}
