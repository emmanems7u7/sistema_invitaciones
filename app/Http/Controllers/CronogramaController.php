<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use App\Models\Invitacion;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function index()
    {
        $cronogramas = Cronograma::all();
        return view('cronogramas.index', compact('cronogramas'));
    }

    public function create()
    {
        $invitaciones = Invitacion::all();
        return view('cronogramas.create', compact('invitaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hora' => 'required|time',
            'actividad' => 'required|string',
            'icono' => 'nullable|string',
            'invitacion_id' => 'required|exists:invitacions,id',
        ]);

        Cronograma::create($request->all());

        return redirect()->route('cronogramas.index');
    }

    public function show(Cronograma $cronograma)
    {
        return view('cronogramas.show', compact('cronograma'));
    }

    public function edit(Cronograma $cronograma)
    {
        $invitaciones = Invitacion::all();
        return view('cronogramas.edit', compact('cronograma', 'invitaciones'));
    }

    public function update(Request $request, Cronograma $cronograma)
    {
        $request->validate([
            'hora' => 'required|time',
            'actividad' => 'required|string',
            'icono' => 'nullable|string',
            'invitacion_id' => 'required|exists:invitacions,id',
        ]);

        $cronograma->update($request->all());

        return redirect()->route('cronogramas.index');
    }

    public function destroy(Cronograma $cronograma)
    {
        $cronograma->delete();
        return redirect()->route('cronogramas.index');
    }
}
