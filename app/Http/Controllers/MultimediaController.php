<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use App\Models\Invitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class MultimediaController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $multimedias = Multimedia::with('invitacion')->paginate(15);
        return view('multimedias.index', compact('multimedias'));
    }

    public function create()
    {
        $invitaciones = Invitacion::all();
        return view('multimedias.create', compact('invitaciones'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'tipo' => 'required|string',
            'archivos' => 'required|array',
            'archivos.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,mov,avi,mp3,wav,ogg'
        ]);

        $bloqueId = $request->input('bloque_id');

        $archivosGuardados = []; // Array para almacenar los registros creados

        foreach ($request->file('archivos') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/multimedia'), $filename);

            $path = 'multimedia/' . $filename;

            $multimedia = Multimedia::create([
                'bloque_id' => $bloqueId,
                'tipo' => $request->input('tipo'),
                'ruta' => $path,
                'galeria' => false, // Por defecto, no es parte de la galería
            ]);

            $archivosGuardados[] = $multimedia; // Agregar el registro creado al arreglo
        }

        return response()->json($archivosGuardados);
    }

    public function show(Multimedia $multimedia)
    {
        return view('multimedias.show', compact('multimedia'));
    }
    public function prueba(Request $request)
    {


        $request->validate([
            'tipo' => 'required|string',
            'archivos' => 'required|array',
            'archivos.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,mov,avi',
        ]);

        $bloqueId = $request->input('bloque_id');

        $archivosGuardados = []; // Array para almacenar los registros creados

        foreach ($request->file('archivos') as $file) {
            $path = $file->store('multimedia', 'public'); // Guardar el archivo en storage

            $multimedia = Multimedia::create([
                'bloque_id' => $bloqueId,
                'tipo' => $request->input('tipo'),
                'ruta' => $path,
                'galeria' => false, // Por defecto, no es parte de la galería
            ]);

            $archivosGuardados[] = $multimedia; // Agregar el registro creado al arreglo
        }

        return response()->json($archivosGuardados);

    }
    public function edit(Multimedia $multimedia)
    {
        $invitaciones = Invitacion::all();
        return view('multimedias.edit', compact('multimedia', 'invitaciones'));
    }

    public function update(Request $request, Multimedia $multimedia)
    {
        $request->validate([
            'invitacion_id' => 'required|exists:invitacions,id',
            'tipo' => 'required|string|max:255',
            'ruta' => 'required|string|max:255',
            'galeria' => 'required|boolean',
        ]);

        $multimedia->update($request->all());
        return redirect()->route('multimedias.index')->with('success', 'Multimedia actualizada correctamente.');
    }

    public function destroy(Multimedia $multimedia)
    {
        $multimedia->delete();
        return redirect()->route('multimedias.index')->with('success', 'Multimedia eliminada correctamente.');
    }

    public function eliminar($id)
    {
        try {
            // Buscar el registro multimedia por ID
            $multimedia = Multimedia::findOrFail($id);

            // Eliminar el archivo físico del almacenamiento
            if (Storage::disk('public')->exists($multimedia->ruta)) {
                Storage::disk('public')->delete($multimedia->ruta);
            }

            // Eliminar el registro de la base de datos
            $multimedia->delete();

            // Retornar una respuesta JSON de éxito
            return response()->json([
                'success' => true,
                'message' => 'Multimedia eliminada correctamente.',
            ]);
        } catch (\Exception $e) {
            // Manejar errores y retornar respuesta
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la multimedia.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
