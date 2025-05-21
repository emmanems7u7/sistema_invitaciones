<?php
namespace App\Http\Controllers;

use App\Models\Componente;
use App\Models\Bloque;
use App\Models\Contenido;
use Illuminate\Http\Request;
use PharIo\Manifest\ComponentElementCollection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
class ComponenteController extends Controller
{
    public function index()
    {
        $componentes = Componente::all();
        $contenidos = Contenido::all();
        return view('componentes.index', compact('componentes', 'contenidos'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo' => 'required|string|max:255',

        ]);


        // Crear el componente en la base de datos
        $componente = Componente::create([
            'tipo' => $request->tipo
        ]);

        $componente->update([
            'nombre' => $componente->tipo . '_' . $componente->id,
        ]);

        // Construir la ruta para la carpeta y el archivo
        $tipoRuta = resource_path('views/componentes/' . $componente->tipo);
        $vistaArchivo = $tipoRuta . '/' . $componente->nombre . '.blade.php';

        // Verificar si la carpeta existe, si no, crearla
        if (!File::exists($tipoRuta)) {
            File::makeDirectory($tipoRuta, 0755, true);
        }

        // Verificar si el archivo ya existe
        if (File::exists($vistaArchivo)) {
            // Si el archivo ya existe, devolver mensaje de error
            return redirect()->route('componentes.index')
                ->with('error', 'El archivo ya existe en la ruta: ' . $vistaArchivo);
        }

        // Crear el archivo .blade.php si no existe
        File::put($vistaArchivo, '');

        // Redirigir o devolver mensaje de éxito
        return redirect()->route('componentes.index')
            ->with('success', 'Componente creado con éxito y archivo generado');
    }

    public function edit($id)
    {
        $componente = Componente::findOrFail($id);
        return response()->json($componente);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        $componente = Componente::findOrFail($id);
        $componente->update($request->all());

        return redirect()->route('componentes.index')->with('success', 'Componente actualizado correctamente.');
    }

    public function destroy($id)
    {
        Componente::findOrFail($id)->delete();
        return redirect()->route('componentes.index')->with('success', 'Componente eliminado correctamente.');
    }
    public function componenetesTipo($id)
    {
        $bloque = Bloque::find($id);


        $componentes = Componente::where('tipo', $bloque->tipo)->get();


        return response()->json($componentes);
    }

    public function componenetesTipot($tipo)
    {

        $componentes = Componente::where('tipo', $tipo)->get();
        return response()->json($componentes);
    }

}

