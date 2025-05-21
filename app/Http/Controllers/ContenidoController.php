<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use Illuminate\Http\Request;

class ContenidoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
        ]);

        $contenido = $request->input('contenido');

        // Generar identificador automáticamente
        $identificador = strtolower($contenido);
        $identificador = str_replace(' ', '_', $identificador);
        $identificador = iconv('UTF-8', 'ASCII//TRANSLIT', $identificador); // quita acentos

        Contenido::create([
            'contenido' => ucfirst(strtolower($contenido)),
            'identificador' => $identificador,
        ]);

        return redirect()->back()->with('success', 'Contenido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contenido $contenido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contenido $contenido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contenido $contenido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contenido $contenido)
    {
        //
    }
}
