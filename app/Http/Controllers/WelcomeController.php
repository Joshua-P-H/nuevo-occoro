<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Models\Documento;
use App\Models\Prensa;




use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index(){
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'documentos' => Documento::all(),
            'prensas' => Prensa::all(),


        ]);
    }
    public function show($id)
    {
      $prensa = Prensa::findOrFail($id);
    
      return Inertia::render('Welcome/PrensaView/Show', [
        'prensa' => $prensa  
      ]); 
    }
}
