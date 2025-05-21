<?php

namespace App\Http\Controllers;

use App\Models\Fuente;
use Illuminate\Http\Request;

class FuenteController extends Controller
{
    public function index($invitacion_id)
    {
        // Obtener los tipos de letra para una invitación específica
        $tiposLetra = Fuente::where('invitacion_id', $invitacion_id)->get();
        return view('tipos_letras.index', compact('tiposLetra', 'invitacion_id'));
    }

    public function store(Request $request)
    {
        // Validación y creación de tipo de letra
        $request->validate([
            'tipo' => 'required|string|max:255',
            'fuente' => 'required|string|max:255',
            'invitacion_id_f' => 'required|exists:invitacions,id',
        ]);


        Fuente::create([
            'invitacion_id' => $request->invitacion_id_f,
            'tipo' => $request->tipo,
            'fuente' => $request->fuente,
        ]);

        return redirect()->back()->with('success', 'Tipo de letra agregado exitosamente.');
    }

    public function edit($id)
    {
        // Obtener tipo de letra a editar
        $fuente = Fuente::findOrFail($id);
        return response()->json($fuente);
    }

    public function update(Request $request, $id)
    {
        // Validación y actualización de tipo de letra
        $request->validate([
            'tipo' => 'required|string|max:255',
            'fuente' => 'required|string|max:255',
        ]);

        $fuente = Fuente::findOrFail($id);
        $fuente->update($request->all());

        return redirect()->back()->with('success', 'Tipo de letra actualizado exitosamente.');
    }

    public function destroy($id)
    {
        // Eliminar tipo de letra
        $fuente = Fuente::findOrFail($id);
        $invitacion_id = $fuente->invitacion_id;
        $fuente->delete();

        return redirect()->route('tipos_letras.index', $invitacion_id)->with('success', 'Tipo de letra eliminado exitosamente.');
    }
}
