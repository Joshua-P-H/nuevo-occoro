<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logo;
use App\Models\Footer;

use Inertia\Inertia;

class HistoriaController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Obtener los datos completos del usuario autenticado

        return Inertia::render('Welcome/Historia/Index', [
            'user' => $user, // Pasar todos los datos del usuario
            'logos' => Logo::all(),
            'footers'=>Footer::all(),

        ]);
    }
}
