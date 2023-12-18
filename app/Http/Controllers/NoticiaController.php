<?php

namespace App\Http\Controllers;

use App\Models\Prensa;
use App\Models\Logo;
use App\Models\Footer;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        return Inertia::render("Welcome/PrensaView/Noticia/Index",[
            'prensas' => Prensa::all(),
            'logos' => Logo::all(),
            'footers'=>Footer::all(),

        ]);
    }
}
