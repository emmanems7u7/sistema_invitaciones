<?php

namespace App\Http\Controllers;

use App\Models\Plantilla;
use Illuminate\Http\Request;
use App\Models\Bloque;
class PlantillaController extends Controller
{
    public function index()
    {
        $plantillas = Plantilla::all();
        return view('plantillas.index', compact('plantillas'));
    }

    public function create()
    {
        return view('plantillas.create');
    }

    public function store(Request $request)
    {
        Plantilla::create($request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'html' => 'required|string',
            'css_path' => 'nullable|string',
            'js_path' => 'nullable|string',
        ]));

        return redirect()->route('plantillas.index')->with('success', 'Plantilla creada correctamente');
    }

    public function show(Plantilla $plantilla)
    {
        return view('plantillas.show', compact('plantilla'));
    }

    public function edit(Plantilla $plantilla)
    {
        return view('plantillas.edit', compact('plantilla'));
    }

    public function update(Request $request, Plantilla $plantilla)
    {
        $plantilla->update($request->validate([
            'nombre' => 'required|string|max:255',
            'html' => 'required|string',
            'css_path' => 'nullable|string|max:255',
        ]));

        return redirect()->route('plantillas.index')->with('success', 'Plantilla actualizada correctamente');
    }

    public function destroy(Plantilla $plantilla)
    {
        $plantilla->delete();
        return redirect()->route('plantillas.index')->with('success', 'Plantilla eliminada correctamente');
    }
    public function getByTipo($id)
    {
        $bloque = Bloque::find($id);


        $plantillas = Plantilla::where('tipo', $bloque->tipo)->get();

        return response()->json($plantillas);
    }
}
