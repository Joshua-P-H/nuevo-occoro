<?php

namespace App\Http\Controllers;

use App\Models\MisionVision;
use App\Models\Logo;
use App\Models\Footer;
use Illuminate\Http\Request;
use Inertia\Inertia;


class MisionVisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Administrador/MisionVision/Index",[
            //'prensas' => Prensa::all(),
            'misiones'=>MisionVision::all(),
            //'footers'=>Footer::all(),


        ]);
    }

    public function misisionvision()
    {
        return Inertia::render("Welcome/MisionVision/Index",[
            //'prensas' => Prensa::all(),
            'logos'=>Logo::all(),
            'footers'=>Footer::all(),
            'misiones'=>MisionVision::all(),


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
            'mision' => ['required', 'string'],
            'vision' => ['required', 'string'], 
        ]);
    
    
    
        MisionVision::create([
            'mision' => $request->input('mision'),
            'vision' => $request->input('vision'),
        ]);
    
        return redirect()->route('misionvision.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MisionVision $misionVision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MisionVision $misionVision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mision' => ['required', 'string'],
            'vision' => ['required', 'string'],
        ]);
    
        $misionVision = MisionVision::findOrFail($id);
    
        $misionVision->update([
            'mision' => $request->input('mision'),
            'vision' => $request->input('vision'),
        ]);
    
        return redirect()->route('misionvision.index');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MisionVision $misionVision)
    {
        //
    }
}
