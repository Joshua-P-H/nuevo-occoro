<?php

namespace App\Http\Controllers;

use App\Models\Prensa;
use App\Models\Logo;
use App\Models\Footer;
use App\Models\Documento;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use Illuminate\Http\Request;

class DocumentoViewController extends Controller
{
    public function index()
    {
        return Inertia::render("Welcome/DocumentoView/Index",[
            'documentos' => Documento::all(),
            'logos'=>Logo::all(),
            'footers'=>Footer::all(),


        ]);
    }
}
