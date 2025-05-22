<?php

namespace App\Http\Controllers;

use App\Models\Invitacion;
use App\Models\User;
use App\Models\Ubicacion;
use App\Models\Fuente;
use App\Models\Invitado;
use App\Models\Mensaje;
use App\Models\Textura;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Hashids\Hashids;

use Carbon\Carbon;

class InvitacionController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
        ];
        $invitaciones = Invitacion::all();
        return view('invitaciones.index', compact('invitaciones', 'breadcrumb'));
    }
    public function previsualizar($id)
    {

        return $this->renderInvitacion($id, false);
    }

    public function generar($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404, 'Invitaci\u00f3n no v\u00e1lida.');
        }

        return $this->renderInvitacion($id, true);
    }

    public function generar_invitado($id, $invitado_id)
    {
        try {
            $hashids = new Hashids(config('app.key'), 10);
            $id = $hashids->decode($id)[0];

            $invitado_id = $hashids->decode($invitado_id)[0];

            $invitado = Invitado::findOrFail($invitado_id);

        } catch (DecryptException $e) {
            abort(404, 'Invitaci\u00f3n no v\u00e1lida.');
        }

        return $this->renderInvitacion($id, $invitado, true);
    }

    private function renderInvitacion($id, $invitado = null, $esGenerado = false)
    {

        $invitacion = Invitacion::with('bloques.textos', 'bloques.multimedias', 'bloques.componente', 'colores')
            ->findOrFail($id);

        $bloques_vista = [];
        if ($invitado != null) {
            $data['invitado'] = $invitado;

        }
        foreach ($invitacion->bloques as $bloque) {
            $data = [
                'posicion' => $bloque->posicion,
                'tipo' => $bloque->tipo,
                'textura' => $bloque->textura_id ? Textura::find($bloque->textura_id)->textura : '',
                'ruta_componente' => $bloque->componente ? 'componentes.' . $bloque->tipo . '.' . $bloque->componente->nombre : 'componentes.default'
            ];

            $data['contenido'] = $this->obtenerContenidoPorTipo($bloque, $id, $data, $invitado);

            $bloques_vista[] = $data;
        }



        usort($bloques_vista, fn($a, $b) => $a['posicion'] <=> $b['posicion']);

        $fuentes = Fuente::where('invitacion_id', $id)->get();
        $nombre_evento = $invitacion->nombre;
        $invitacion_id = $id;

        return view('bodas.plantilla_1', compact(
            'bloques_vista',
            'invitacion',
            'id',
            'nombre_evento',
            'invitacion_id',
            'fuentes'
        ));
    }

    private function obtenerContenidoPorTipo($bloque, $id, &$data, $invitado = null)
    {

        switch ($bloque->tipo) {
            case 'carrusel':
                return [
                    'titulo' => $bloque->textos->firstWhere('tipo', 'Titulo')->contenido ?? '',
                    'subtitulo' => $bloque->textos->firstWhere('tipo', 'Subtitulo')->contenido ?? '',
                    'imagenes' => $bloque->multimedias->where('tipo', 'imagen')->pluck('ruta')->toArray(),
                    'video' => $bloque->multimedias->where('tipo', 'video')->pluck('ruta')->first(),
                ];

            case 'info_general':
            case 'boton_recuerdos':
                return [
                    'titulo' => $bloque->textos->firstWhere('tipo', 'Titulo')->contenido ?? '',
                    'subtitulo' => $bloque->textos->firstWhere('tipo', 'Subtitulo')->contenido ?? '',
                    'parrafo' => $bloque->textos->firstWhere('tipo', 'Parrafo')->contenido ?? '',
                ];

            case 'info':
                return $this->formatearInfo($bloque);

            case 'galeria':
            case 'galeria_2':
            case 'reproductor_audio':
                return $this->formatearGaleriaAudio($bloque, $data);

            case 'hora':
                return $this->formatearHora($bloque, $id, $data);

            case 'ubicacion':
                return $this->formatearUbicaciones($id);


            case 'recuerdos_cargados':
                return Mensaje::with('multimedia')->where('invitacion_id', $id)->get();

            case 'asistencia':
                return [
                    'titulo' => $bloque->textos->firstWhere('tipo', 'Titulo')->contenido ?? '',
                    'subtitulo' => $bloque->textos->firstWhere('tipo', 'Subtitulo')->contenido ?? '',
                    'parrafo' => $bloque->textos->firstWhere('tipo', 'Parrafo')->contenido ?? '',
                    'invitado' => $invitado,
                ];
        }

        return [];
    }

    private function formatearInfo($bloque)
    {
        $titulo = $subtitulo = $parrafo = '';
        $contenido = [];

        foreach ($bloque->textos as $texto) {
            if ($texto->tipo === 'Titulo')
                $titulo = $texto->contenido;
            elseif ($texto->tipo === 'Subtitulo')
                $subtitulo = $texto->contenido;
            elseif ($texto->tipo === 'Parrafo') {
                $parrafo = $texto->contenido;
                $contenido[] = compact('titulo', 'subtitulo', 'parrafo');
            }
        }

        foreach ($bloque->multimedias as $index => $media) {
            if ($media->tipo === 'imagen')
                $contenido[$index]['imagen'] = $media->ruta;
        }

        return $contenido;
    }

    private function formatearGaleriaAudio($bloque, &$data)
    {
        $contenido = [];
        $data['titulo'] = $bloque->textos->firstWhere('tipo', 'Titulo')->contenido ?? '';
        $data['subtitulo'] = $bloque->textos->firstWhere('tipo', 'Subtitulo')->contenido ?? '';

        foreach ($bloque->multimedias as $index => $media) {
            if ($media->tipo === 'imagen')
                $contenido[$index]['imagen'] = $media->ruta;
            if ($media->tipo === 'audio')
                $contenido[$index]['audio'] = $media->ruta;
        }

        return $contenido;
    }

    private function formatearHora($bloque, $id, &$data)
    {
        $titulo = $subtitulo = $parrafo = '';
        $contenido = [];

        foreach ($bloque->textos as $texto) {
            if ($texto->tipo === 'Titulo')
                $titulo = $texto->contenido;
            elseif ($texto->tipo === 'Subtitulo') {
                $subtitulo = $texto->contenido;
                $contenido[] = compact('titulo', 'subtitulo', 'parrafo');
            }
        }

        foreach ($bloque->multimedias as $index => $media) {
            if ($media->tipo === 'imagen')
                $contenido[$index]['imagen'] = $media->ruta;
        }

        $ubi_invi = Ubicacion::where('invitacion_id', $id)->first();
        $data['fechaHora'] = $ubi_invi ? $ubi_invi->fecha . ' ' . $ubi_invi->hora_inicio : null;

        return $contenido;
    }

    private function formatearUbicaciones($id)
    {
        Carbon::setLocale('es');

        return Ubicacion::where('invitacion_id', $id)->get()->map(function ($ubicacion) {
            $ubicacion->fecha = Carbon::parse($ubicacion->fecha)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
            $ubicacion->hora_inicio = Carbon::parse($ubicacion->hora_inicio)->format('H:i');
            return $ubicacion;
        });
    }
    public function extraerTexto($objeto, $tipo)
    {
        foreach ($objeto as $texto) {
            if ($texto->tipo == $tipo) {
                return $texto->contenido;
            }
        }
    }
    public function create($id)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'invitaciones', 'url' => route('home')],
        ];
        $user_id = $id;
        $invitaciones = Invitacion::with('ubicaciones')->where('user_id', $id)->get();
        //dd($invitaciones);
        return view('invitaciones.create', compact('user_id', 'invitaciones', 'breadcrumb'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'nombre' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'actividades' => 'required|string'
        ]);

        $invitacion = Invitacion::create([
            'tipo' => $request->tipo,
            'nombre' => $request->nombre,
            'user_id' => $request->user_id
        ]);

        $actividades = json_decode($request->input('actividades'), true);

        foreach ($actividades as $actividad) {
            $imagenPath = null;

            // Verifica si hay una imagen y la guarda en el storage
            if ($request->hasFile('imagenes') && isset($actividad['imagen'])) {
                $imagenFile = $request->file('imagenes')[$actividad['imagen']];

                $nombreArchivo = time() . '_' . $imagenFile->getClientOriginalName();
                $rutaDestino = public_path('storage/actividades');

                // Asegúrate que exista la carpeta
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0755, true);
                }

                $imagenFile->move($rutaDestino, $nombreArchivo);

                $imagenPath = 'storage/actividades/' . $nombreArchivo; // ruta relativa para uso en la app o DB
            }

            Ubicacion::create([
                'invitacion_id' => $invitacion->id,
                'actividad' => $actividad['actividad'],
                'fecha' => $actividad['fecha'],
                'hora_inicio' => $actividad['horaInicio'],
                'direccion' => $actividad['direccion'],
                'geolocalizacion' => $actividad['geolocalizacion'],
                'icono' => $actividad['icono'] ?? null,
                'imagen' => $imagenPath
            ]);
        }

        return redirect()->back()->with('success', 'Invitacion creada correctamente');


    }

    public function show($id)
    {
        return view('invitaciones.show');

    }
    public function show_boda($id)
    {
        $invitacion = Invitacion::with('bloques');
        return view('bodas.plantilla_1');
    }
    public function edit(Invitacion $invitacion)
    {
        $users = User::all();
        return view('invitaciones.edit', compact('invitacion', 'users'));
    }

    public function update(Request $request, Invitacion $invitacion)
    {
        $request->validate([
            'tipo' => 'required|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|time',
            'user_id' => 'required|exists:users,id',
            'direccion' => 'required|string',
        ]);

        $invitacion->update($request->all());

        return redirect()->route('invitaciones.index');
    }

    public function destroy(Invitacion $invitacion)
    {
        $invitacion->delete();
        return redirect()->route('invitaciones.index');
    }
}
