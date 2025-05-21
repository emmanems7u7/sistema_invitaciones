<div class="container-fluid" id="family">
    <div class="container">

        <div class="row portfolio-container">

            @foreach ($bloque['contenido'] as $index => $contenido)

                <div class="col-lg-4 col-md-6 mb-4 portfolio-item  {{$index % 2 != 0 ? 'first' : 'second' }}">
                    <div class="position-relative mb-2">
                        <img class="img-fluid w-100" src="{{asset('storage/' . $contenido['imagen'])}}" alt="">
                        <div class="bg-secondary text-center p-4">
                            <h4 class="mb-3">{{$bloque['titulo']}}</h4>
                            <p class="text-uppercase">{{$bloque['subtitulo']}}</p>

                        </div>
                    </div>
                </div>


            @endforeach

        </div>
    </div>
</div>