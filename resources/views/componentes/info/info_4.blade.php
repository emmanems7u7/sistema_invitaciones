@if(isset($bloque['contenido']))
    <div class="container-fluid" id="about">
        <div class="container">
            @foreach ($bloque['contenido'] as $index => $info)


                <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0">
                    @if($index % 2 != 0)
                        <div class="col-md-6 p-0" style="min-height: 400px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('storage/' . $info['imagen']) }}"
                                style="object-fit: cover;">
                        </div>
                    @endif

                    <div class="col-md-6 p-0 text-center text-md-{{ $index % 2 == 0 ? 'right' : 'left' }} ">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                            <h3 class="mb-3">{{$info['titulo']}} </h3>
                            <p>{{$info['parrafo']}}</p>
                            <h3 class="font-secondary font-weight-normal text-muted mb-3">{{$info['subtitulo']}}</h3>

                        </div>
                    </div>

                    @if($index % 2 == 0)
                        <div class="col-md-6 p-0" style="min-height: 400px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('storage/' . $info['imagen']) }}"
                                style="object-fit: cover;">
                        </div>
                    @endif
                </div>

            @endforeach

        </div>
    </div>
@endif