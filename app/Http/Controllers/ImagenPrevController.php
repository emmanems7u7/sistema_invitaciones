<?php

namespace App\Http\Controllers;

use App\Models\ImagenPrev;
use App\Models\invitacion;
use Illuminate\Http\Request;

class ImagenPrevController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Mover el archivo a public/storage/multimedia
            $file->move(public_path('storage/multimedia'), $filename);

            // Ruta relativa para almacenar en DB o retornar
            $path = 'storage/multimedia/' . $filename;

            $invitacion = invitacion::findOrFail($id);

            ImagenPrev::create([
                'invitacion_id' => $invitacion->id,
                'ruta' => $path
            ]);

            return back()->with('success', 'Imagen subida correctamente')->with('ruta', $path);
        }

        return back()->withErrors(['imagen' => 'No se pudo subir la imagen']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ImagenPrev $imagenPrev)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImagenPrev $imagenPrev)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImagenPrev $imagenPrev)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imagen = ImagenPrev::findOrFail($id);

        // Obtener la ruta del archivo físico (por ejemplo: 'storage/multimedia/archivo.jpg')
        $rutaArchivo = public_path($imagen->ruta);

        // Verificar si el archivo existe y eliminarlo
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        // Eliminar el registro de la base de datos
        $imagen->delete();

        return back()->with('success', 'Imagen eliminada correctamente');
    }
}
