<?php

namespace App\Http\Controllers;

use App\Models\Acompanante;
use App\Models\Invitacion;
use Illuminate\Http\Request;

class AcompananteController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Acompanante::class, 'acompanante');
    }

    public function index()
    {
        $acompanantes = Acompanante::with('invitacion')->paginate(15);
        return view('acompanantes.index', compact('acompanantes'));
    }

    public function create()
    {
        $invitaciones = Invitacion::all();
        return view('acompanantes.create', compact('invitaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'invitacion_id' => 'nullable|exists:invitacions,id',
        ]);

        Acompanante::create($request->all());
        return redirect()->route('acompanantes.index')->with('success', 'Acompañante creado correctamente.');
    }

    public function show(Acompanante $acompanante)
    {
        return view('acompanantes.show', compact('acompanante'));
    }

    public function edit(Acompanante $acompanante)
    {
        $invitaciones = Invitacion::all();
        return view('acompanantes.edit', compact('acompanante', 'invitaciones'));
    }

    public function update(Request $request, Acompanante $acompanante)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'invitacion_id' => 'nullable|exists:invitacions,id',
        ]);

        $acompanante->update($request->all());
        return redirect()->route('acompanantes.index')->with('success', 'Acompañante actualizado correctamente.');
    }

    public function destroy(Acompanante $acompanante)
    {
        $acompanante->delete();
        return redirect()->route('acompanantes.index')->with('success', 'Acompañante eliminado correctamente.');
    }
}
