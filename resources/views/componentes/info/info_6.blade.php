@if(isset($bloque['contenido']))
    <div class="container-fluid py-5" id="story">
        <div class="container pt-5 pb-3">

            <div class="container timeline position-relative p-0">
                @foreach ($bloque['contenido'] as $index => $info)
                    <div class="row">
                        @if($index % 2 == 0)
                            <div class="col-md-6 text-center text-md- {{$index % 2 != 0 ? 'right' : 'left' }}">
                                <img class="img-fluid mr-md-3" src=" {{ asset('storage/' . $info['imagen']) }} " alt="">
                            </div>
                        @endif
                        <div class="col-md-6 text-center text-md-{{$index % 2 == 0 ? 'left' : 'right' }}">
                            <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 ml-md-3">
                                <h4 class="mb-2 " style="color: #fff">{{$info['titulo']}} </h4>
                                <p class="text-uppercase mb-2">{{$info['subtitulo']}}</p>
                                <p class="m-0" style="#f5f5f5">{{$info['parrafo']}}</p>
                            </div>
                        </div>
                        @if($index % 2 != 0)
                            <div class="col-md-6 text-center text-md- {{$index % 2 == 0 ? 'right' : 'left' }}">
                                <img class="img-fluid mr-md-3" src="{{ asset('storage/' . $info['imagen']) }}" alt="">
                            </div>
                        @endif
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endif