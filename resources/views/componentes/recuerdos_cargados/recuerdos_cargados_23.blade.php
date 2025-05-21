<!-- Lightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css" rel="stylesheet" />

<!-- Lightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>

<!-- imagesLoaded -->
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

<!-- Isotope -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<div class="container-fluid">

    <div class="row  mb-5">
        @foreach ($bloque['contenido'] as $mensaje)
            <div class="col-md-4 mt-2 shadow-sm">
                <div class="card  h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-3">Mensaje de {{ $mensaje->nombre }}</h5>
                        <p class="card-text">{{ $mensaje->mensaje }}</p>
                        <p class="text-muted small">Contenido cargado</p>

                        @if ($mensaje->multimedia->count())
                            <div id="galeria-{{ $mensaje->id }}" class="row g-2">
                                @foreach ($mensaje->multimedia as $archivo)
                                    <div class="col-4">
                                        <a href="{{ asset('storage/' . $archivo->ruta) }}"
                                            data-lightbox="galeria-{{ $mensaje->id }}"
                                            data-title='{!! $archivo->nombre !!} - <a href="{{ asset("storage/" . $archivo->ruta) }}" class="text-white" download>Descargar</a>'>
                                            <img src="{{ asset('storage/' . $archivo->ruta) }}" alt="{{ $archivo->nombre }}"
                                                class="img-fluid rounded border" loading="lazy" />
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted"><em>No hay archivos multimedia asociados.</em></p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<style>
    .lightbox .lb-caption a {
        color: #00f;
        text-decoration: underline;
        margin-left: 10px;
        font-weight: bold;
    }

    .lightbox .lb-caption a:hover {
        color: #0056b3;
    }

    .grid {
        max-width: 100%;
    }

    .grid {
        display: flex;
        flex-wrap: wrap;
        margin: -5px;
    }

    .grid-sizer,
    .grid-item {
        width: 33.3333%;
        box-sizing: border-box;
        padding: 5px;
    }

    .grid-item {
        display: flex;
        justify-content: center;
    }

    .grid-item img {
        width: 100%;
        max-width: 100%;
        height: auto;
        border-radius: 0.25rem;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
        cursor: pointer;
        display: block;
    }

    .grid-item img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const grids = document.querySelectorAll('.grid');
        grids.forEach(function (grid) {
            imagesLoaded(grid, function () {
                new Isotope(grid, {
                    itemSelector: '.grid-item',
                    percentPosition: true,
                    masonry: {
                        columnWidth: '.grid-sizer'
                    }
                });
            });
        });
    });
</script>