@if(isset($bloque['contenido']))

    <div class="container-fluid mt-5 mb-2" @if(!empty($bloque['textura']))
        style="background-image: url('{{ asset('storage/' . $bloque['textura']) }}');     padding: 34px 0px 0px;;  background-position: center; "
    @endif>

        <div class="section-title position-relative text-center ">

            <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">{{$bloque['contenido']['subtitulo']}}
            </h6>
            <h1 class="font-secondary display-4">{{$bloque['contenido']['titulo']}}</h1>
            <i class="far fa-heart text-dark"></i>
        </div>
        @if($bloque['contenido']['parrafo'] != '')
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h5 class="font-weight-normal text-muted mb-3 pb-3">{{$bloque['contenido']['parrafo']}}
                    </h5>
                </div>
            </div>
        @endif
    </div>
@endif