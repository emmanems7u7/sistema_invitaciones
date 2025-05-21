<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use Illuminate\Http\Request;
use App\Models\Textura;
use Illuminate\Support\Facades\Storage;

class TexturaController extends Controller
{
    function texturas()
    {
        $texturas = Textura::all()->map(function ($textura) {
            return [
                'id' => $textura->id,
                'ruta' => Storage::url($textura->textura),

            ];
        });
        return response()->json($texturas);
    }

    public function storeTextura(Request $request)
    {
        foreach ($request->file('archivos') as $file) {
            // Generar un ID único con la extensión original
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Mover el archivo directamente a public/texturas
            $file->move(public_path('storage/texturas'), $filename);

            // Construir la ruta accesible
            $path = 'texturas/' . $filename;

            $multimedia = Textura::create([
                'textura' => $path,
            ]);


        }
        return redirect()->back();
    }
    public function asociar_textura(Request $request, $id)
    {
        $request->validate([
            'textura' => 'required|integer|exists:texturas,id',
        ]);

        $bloque = Bloque::find($id);

        $bloque->textura_id = $request->textura;

        $bloque->save();

        return redirect()->back();
    }
    public function destroy(Bloque $bloque)
    {
        $bloque->textura_id = null;
        $bloque->save();
        return redirect()->back()->with('success', 'Textura eliminada correctamente.');
    }
}
