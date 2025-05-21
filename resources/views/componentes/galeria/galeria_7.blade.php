<!-- Gallery Start -->
@php
    $i = rand(0, count($bloque['contenido']) - 1);
@endphp

<div class="container-fluid mb-5" id="gallery" style="padding: 50px 0; margin: 0px 0; background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('storage/' . $bloque['contenido'][$i]['imagen']) }}'), no-repeat center center;
  background-size: cover;">
    <div class="section-title position-relative text-center" style="margin-bottom: 120px;">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">{{$bloque['subtitulo']}} </h6>
        <h1 class="font-secondary display-4 text-white">{{$bloque['titulo']}}</h1>
        <i class="far fa-heart text-white"></i>
    </div>
    <div class="owl-carousel gallery-carousel">
        @foreach ($bloque['contenido'] as $index => $contenido)
            <div class="gallery-item">
                <img class="img-fluid w-100" src="{{asset('storage/' . $contenido['imagen'])}} " alt="">
                <a href="{{asset('storage/' . $contenido['imagen'])}} " data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>

        @endforeach
    </div>
</div>
<!-- Gallery End -->