<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Obtener los datos completos del usuario autenticado

        return Inertia::render('Administrador/User/Index', [
            'user' => $user, // Pasar todos los datos del usuario
        ]);
    }
}
