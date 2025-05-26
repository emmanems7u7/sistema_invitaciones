<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;
use App\Models\Invitacion;
use App\Models\Imagen;
use App\Models\Multimedia_mensaje;
use Illuminate\Support\Facades\Storage;

class MensajeController extends Controller
{
    public function index($invitacion_id)
    {
        $invitacion = Invitacion::findOrFail($invitacion_id);
        $mensajes = $invitacion->mensajes; // Obtener mensajes de esta invitación
        return view('mensajes.index', compact('invitacion', 'mensajes'));
    }

    public function create($invitacion_id)
    {
        return view('mensajes.create', compact('invitacion_id'));
    }

    public function store(Request $request, $invitacion_id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $mensaje = Mensaje::create([
            'invitacion_id' => $invitacion_id,
            'nombre' => $request->nombre,
            'mensaje' => $request->mensaje
        ]);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $image) {


                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/imagenes'), $filename);

                $path = 'imagenes/' . $filename;


                // Crear una entrada en la tabla imagenes
                Multimedia_mensaje::create([
                    'ruta' => $path,
                    'mensaje_id' => $mensaje->id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Mensaje agregado');
    }

    public function destroy($id)
    {
        $mensaje = Mensaje::findOrFail($id);

        // Eliminar archivos multimedia relacionados si existen
        if ($mensaje->multimedia->count()) {
            foreach ($mensaje->multimedia as $archivo) {
                if (Storage::exists($archivo->ruta)) {
                    Storage::delete($archivo->ruta);
                }
                $archivo->delete(); // Elimina el registro de la base de datos
            }
        }

        $mensaje->delete();

        return redirect()->back()->with('success', 'Mensaje eliminado correctamente.');
    }
}