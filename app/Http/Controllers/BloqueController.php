<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Colores;
use App\Models\Contenido;
use App\Models\Fuente;
use App\Models\Ubicacion;
use App\Models\Invitado;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Hashids\Hashids;

class BloqueController extends Controller
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
    public function create($id)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Añadir Componentes', 'url' => route('home')],
        ];

        $bloques = Bloque::with('textos', 'multimedias')
            ->where('invitacion_id', $id)
            ->orderBy('posicion', 'asc')
            ->get();
        $fuentes = Fuente::where('invitacion_id', $id)->get();

        $ubicaciones = Ubicacion::where('invitacion_id', $id)->get();
        $colores = Colores::where('invitacion_id', $id)->get();
        $contenidos = Contenido::all();
        $hashids = new Hashids(config('app.key'), 10);
        $invitados = Invitado::where('invitacion_id', $id)->get()->map(function ($invitado) use ($id, $hashids) {
            $invitado->enlace = route('invitacion.generar_invitado', [
                'id' => $hashids->encode($id),
                'invitado_id' => $hashids->encode($invitado->id)
            ]);
            return $invitado;
        });


        return view('bloques.create', compact('breadcrumb', 'invitados', 'id', 'bloques', 'colores', 'ubicaciones', 'fuentes', 'contenidos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {
            $request->validate([
                'tipo_bloque' => 'required|string',
                'posicion' => [
                    'required',
                    'integer',
                    'min:1',
                    Rule::unique('bloques')->where(function ($query) use ($request) {
                        return $query->where('invitacion_id', $request->invitacion_id);
                    }),
                ],
                'invitacion_id' => 'required|exists:invitacions,id',
                'componente' => 'required|exists:componentes,id',
            ], [
                'posicion.unique' => 'La posición ingresada ya está ocupada para esta invitación.',
                'posicion.required' => 'El campo posición es obligatorio.',
                'posicion.integer' => 'La posición debe ser un número entero.',
                'posicion.min' => 'La posición debe ser al menos 1.',
            ]);



            Bloque::create([
                'tipo' => $request->tipo_bloque,
                'posicion' => $request->posicion,
                'invitacion_id' => $request->invitacion_id,
                'componente_id' => $request->componente,
            ]);
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado. Intenta nuevamente.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bloque $bloque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bloque $bloque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bloque $bloque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bloque $bloque)
    {
        try {
            $bloque->delete();
            return redirect()->back()->with('success', 'Bloque eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el bloque. Inténtalo nuevamente.');
        }
    }

    public function storePlantilla(Request $request)
    {
        try {
            $request->validate([
                'plantillaSeleccionada' => 'required|exists:componentes,id',
                'bloque_plantilla_id' => 'required|exists:bloques,id',
            ]);

            $bloque = Bloque::find($request->bloque_plantilla_id);

            $bloque->componente_id = $request->plantillaSeleccionada;
            $bloque->save();


            return redirect()->back()->withInput()->with('success', 'Plantilla Guardada');

        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado. Intenta nuevamente.');
        }
    }

    public function updatePosicion(Request $request)
    {
        $updatedPositions = [];

        foreach ($request->orden as $item) {
            $bloque = Bloque::where('id', $item['id'])->update(['posicion' => $item['posicion']]);
            $updatedPositions[] = [
                'id' => $item['id'],
                'posicion' => $item['posicion']
            ];
        }

        return response()->json(['success' => true, 'updatedPositions' => $updatedPositions]);
    }


}
