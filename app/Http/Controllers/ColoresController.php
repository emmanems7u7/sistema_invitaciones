<?php

namespace App\Http\Controllers;

use App\Models\Colores;
use App\Models\Invitacion;
use Illuminate\Http\Request;

class ColoresController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $colores = Colores::with('invitacion')->paginate(15);
        return view('colores.index', compact('colores'));
    }

    public function create()
    {
        $invitaciones = Invitacion::all();
        return view('colores.create', compact('invitaciones'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'invitacion_id' => 'required|exists:invitacions,id',
            'codigo' => 'required|string|max:12',
            'tipo' => 'required|string|max:255',
        ]);

        Colores::create([
            'invitacion_id' => $request->invitacion_id,
            'codigo' => $request->codigo,
            'tipo' => $request->tipo,
        ]);
        return redirect()->back()->with('success', 'Color creado correctamente.');
    }

    public function prueba(Request $request)
    {
        dd($request);
    }
    public function show(Colores $color)
    {
        // return view('colores.show', compact('color'));
    }

    public function edit($id)
    {
        $colores = Colores::find($id);
        return response()->json(['colores' => $colores]);
    }

    public function update(Request $request, $id)
    {

        $color = Colores::findOrFail($id);
        $request->validate([
            'invitacion_id' => 'required|exists:invitacions,id',
            'codigo' => 'required|string|max:12',
            'tipo' => 'required|string|max:255',
        ]);


        $color->codigo = $request->codigo;
        $color->tipo = $request->tipo;
        $color->save();

        return redirect()->back()->with('success', 'Color actualizado correctamente.');
    }

    public function destroy($id)
    {
        $color = Colores::find($id);

        if (!$color) {
            return response()->json(['error' => 'Color no encontrado'], 404);
        }
        $color->delete();

        return redirect()->back()->with('success', 'Color eliminado correctamente.');
    }
}
