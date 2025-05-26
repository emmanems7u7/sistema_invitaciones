@php
    use Hashids\Hashids;

    $invitado = $bloque['contenido']['invitado'] ?? null;
    $hashids = new Hashids(config('app.key'), 10);
    $hashedId = null;
    $confirmarRuta = null;

    if ($invitado && isset($invitado->id)) {
        $hashedId = $hashids->encode($invitado->id);
        $confirmarRuta = route('asistencia.confirmar', ['invitado_id' => $hashedId]);
    }
@endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Tema opcional -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<style>
    .alertify .ajs-dialog {
        top: 50% !important;
        transform: translateY(-50%) !important;
        margin-top: 0 !important;
    }
</style>
@if(isset($bloque['contenido']) && $confirmarRuta)
    <div class="container-fluid" @if(!empty($bloque['textura']))
        style="background-image: url('{{ asset('storage/' . $bloque['textura']) }}'); padding: 10px; background-position: center;"
    @endif>
        <div class="section-title position-relative text-center mt-5 mb-2">
            <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">
                {{ $bloque['contenido']['invitado']->nombre_completo }}
            </h6>
            <h4 class="font-secondary display-7"> {{ $bloque['contenido']['titulo'] }}</h4>
            <i class="far fa-heart text-dark"></i>
        </div>

        <div class="position-relative text-center mb-2">
            <button onclick="confirmarAsistencia()" class="btn btn-primary btn-lg px-5 shadow-sm mt-3">
                Confirmar
            </button>
        </div>

        @if(!empty($bloque['contenido']['parrafo']))
            <div class="row justify-content-center mb-4">
                <div class="col-md-6 text-center">
                    <h5 class="font-weight-normal text-muted mb-3 pb-3">{{ $bloque['contenido']['parrafo'] }}</h5>
                </div>
            </div>
        @endif
    </div>

    <script>
        function confirmarAsistencia() {
            const url = @json($confirmarRuta);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({})
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la confirmación');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status == 1) {
                        alertify.alert('Éxito', data.message || 'Asistencia confirmada');
                    } else {
                        alertify.error(data.message);
                    }
                })
                .catch(error => {
                    alert('Error al confirmar asistencia');
                    console.error(error);
                });
        }
    </script>
@endif