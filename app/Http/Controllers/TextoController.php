<?php

namespace App\Http\Controllers;

use App\Models\Texto;
use App\Models\Invitacion;
use Illuminate\Http\Request;

class TextoController extends Controller
{
    public function index()
    {
        $textos = Texto::all();
        return view('textos.index', compact('textos'));
    }

    public function create()
    {
        $invitaciones = Invitacion::all();
        return view('textos.create', compact('invitaciones'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'textos' => 'required|array',
            'textos.*.tipo' => 'required|string|in:Titulo,Subtitulo,Parrafo',
            'textos.*.contenido' => 'required|string',
            'bloque_id' => 'required|exists:bloques,id',
        ]);

        foreach ($request->textos as $texto) {
            // Guardar en la base de datos y almacenar el registro en el array
            $nuevoTexto = Texto::create([
                'tipo' => $texto['tipo'],
                'contenido' => $texto['contenido'],
                'bloque_id' => $request->bloque_id,
            ]);

            $textosCreados[] = $nuevoTexto;
        }

        return response()->json($textosCreados);
    }

    public function show(Texto $texto)
    {
        return view('textos.show', compact('texto'));
    }

    public function edit($id)
    {
        $texto = Texto::findOrFail($id); // Buscar el texto por ID
        return response()->json(['texto' => $texto]); // Devolver los datos en formato JSON
    }

    public function update(Request $request, $id)
    {
        $texto = Texto::findOrFail($id); // Buscar el texto por ID

        // Validar los datos
        $request->validate([
            'tipo' => 'required|string',
            'contenido' => 'required|string',
        ]);

        // Actualizar el texto
        $texto->update($request->all());

        return response()->json($texto);
    }

    public function destroy($id)
    {
        $texto = Texto::findOrFail($id); // Buscar el texto por ID

        // Eliminar el texto
        $texto->delete();

        // Retornar una respuesta JSON indicando éxito
        return redirect()->back();
    }
}
