<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$documentos = Documento::all();

        return Inertia::render('Administrador/Documento/Index', compact('documentos'));*/
        return Inertia::render("Administrador/Documento/Index", [
            'documentos' => Documento::all(),

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
            'name_documento' => ['required', 'max:50'],
            'image_documento' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
            'pdf_documento' => 'file|mimes:pdf|max:10048',
        ]);

        $imageName = $request->file('image_documento')->getClientOriginalName(); // Obtiene el nombre original del archivo

        $request->file('image_documento')->storeAs('images', $imageName, 'public'); // Guarda la imagen con su nombre original

        $pdfName = $request->file('pdf_documento')->getClientOriginalName();
        $request->file('pdf_documento')->storeAs('pdfs', $pdfName, 'public');


        Documento::create([
            'name_documento' => $request->input('name_documento'),
            'image_documento' => 'images/' . $imageName, // Guarda en la base de datos el nombre del archivo
            'pdf_documento' => 'pdfs/' . $pdfName,

        ]);

        return redirect()->route('documentos.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        /*return Inertia::render('Administrador/Documento/Edit', [
    'documento' => $documento
]);*/
        return Inertia::render('Administrador/Documento/Edit', [
            'documento' => $documento,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documento $documento)
    {
        try {
            // Verificar si se está actualizando también la imagen
            if ($request->hasFile('image_documento')) {
                $request->validate([
                    'name_documento' => ['required', 'max:50'],
                    'image_documento' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
                    // Validar la imagen si está presente
                ]);
    
                $image = $request->file('image_documento');
                $imageName = $image->getClientOriginalName(); // Obtener el nombre original
    
                $imagePath = $image->storeAs('images', $imageName, 'public'); // Guardar con su nombre original
    
                // Actualizar la ruta de la nueva imagen en la base de datos
                $documento->image_documento = $imagePath;
            } else {
                // Si no se actualiza la imagen, validar solo el nombre del documento
                $request->validate([
                    'name_documento' => ['required', 'max:50'],
                ]);
            }
    
            // Verificar si se está actualizando también el archivo PDF
            if ($request->hasFile('pdf_documento')) {
                $request->validate([
                    'pdf_documento' => 'nullable|mimes:pdf|max:2048',
                    // Validar el archivo PDF si está presente
                ]);
    
                $pdf = $request->file('pdf_documento');
                $pdfName = $pdf->getClientOriginalName(); // Obtener el nombre original
    
                $pdfPath = $pdf->storeAs('pdfs', $pdfName, 'public'); // Guardar con su nombre original
    
                // Actualizar la ruta del nuevo archivo PDF en la base de datos
                $documento->pdf_documento = $pdfPath;
            }
    
            $documento->name_documento = $request->input('name_documento');
            $documento->save();
            return redirect()->route('documentos.index');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el documento'], 500);
        }
    }
    









    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        $documento->delete();
        return to_route('documentos.index');
    }
}
