<div class="container-fluid p-0 mb-5 pb-5" id="home">
    <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">

            @if(isset($bloque['contenido']['imagenes']) && is_array($bloque['contenido']['imagenes']))
                @foreach ($bloque['contenido']['imagenes'] as $index => $imagen)
                    <div class="carousel-item position-relative {{ $index == 0 ? 'active' : '' }}"
                        style="height: 100vh; min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('storage/' . $imagen) }}"
                            style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">{{$bloque['contenido']['titulo']}}
                                </h1>
                                <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                    <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">
                                        {{$bloque['contenido']['subtitulo']}}
                                    </h3>
                                </div>
                                @if (!empty($bloque['contenido']['video']))
                                    <button type="button" class="btn-play mx-auto" data-toggle="modal"
                                        data-src="{{ asset('storage/' . $bloque['contenido']['video']) }}"
                                        data-target="#videoModal">
                                        <span></span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <a class="carousel-control-prev justify-content-start" href="#header-carousel" data-slide="prev" style="    position: absolute;
    top: 90%;">
            <div class="btn btn-primary px-0" style="width: 68px; height: 68px;">
                <span class="carousel-control-prev-icon mt-3"></span>
            </div>
        </a>
        <a class="carousel-control-next justify-content-end" href="#header-carousel" data-slide="next" style="    position: absolute;
    top: 90%;">
            <div class="btn btn-primary px-0" style="width: 68px; height: 68px;">
                <span class="carousel-control-next-icon mt-3"></span>
            </div>
        </a>
    </div>
</div>
<!-- Carousel End -->


<!-- Video Modal Start -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                        allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->