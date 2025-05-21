<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use Illuminate\Http\Request;

class CelularController extends Controller
{
    public function index()
    {
        $celulares = Celular::all();
        return view('celulares.index', compact('celulares'));
    }

    public function create()
    {
        return view('celulares.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'celular' => 'required|string',
            'whatsapp' => 'required|boolean',
            'tipo_id' => 'required|integer',
            'tipo_type' => 'required|string',
        ]);

        Celular::create($request->all());

        return redirect()->route('celulares.index');
    }

    public function show(Celular $celular)
    {
        return view('celulares.show', compact('celular'));
    }

    public function edit(Celular $celular)
    {
        return view('celulares.edit', compact('celular'));
    }

    public function update(Request $request, Celular $celular)
    {
        $request->validate([
            'celular' => 'required|string',
            'whatsapp' => 'required|boolean',
            'tipo_id' => 'required|integer',
            'tipo_type' => 'required|string',
        ]);

        $celular->update($request->all());

        return redirect()->route('celulares.index');
    }

    public function destroy(Celular $celular)
    {
        $celular->delete();
        return redirect()->route('celulares.index');
    }
}
