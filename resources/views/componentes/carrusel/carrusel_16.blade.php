<link href="{{ asset('css/pogo-slider.min.css') }}" rel="stylesheet">

<style>
    /*------------------------------------------------------------------
    Banner
-------------------------------------------------------------------*/

    .lbox-caption {
        display: table;
        height: 100%;
        width: 100%;
    }

    .lbox-caption {
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        z-index: 10;
    }

    .lbox-details {
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        position: relative;
    }

    .lbox-details::before {
        content: "";
        background: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 2;
    }

    .lbox-details h1 {
        font-size: 68px;
        font-family: 'Marck Script', cursive;
        color: #ffffff;
        position: relative;
        z-index: 3;
    }

    .lbox-details h2 {
        font-size: 48px;
        color: #ffffff;
        position: relative;
        z-index: 3;
    }

    .lbox-details p {
        color: #ffffff;
        position: relative;
        z-index: 3;
    }

    .lbox-details p strong {
        color: #dd666c;
        font-size: 40px;
        font-family: 'Marck Script', cursive;
    }

    .lbox-details a.btn {
        background: #63c7bd;
        padding: 10px 20px;
        font-size: 20px;
        text-transform: uppercase;
        color: #ffffff;
        border-radius: 0px;
        position: relative;
        z-index: 3;
    }

    .lbox-details a.btn:hover {
        background: #dd666c;
    }
</style>
<div class="ulockd-home-slider">
    <div class="container-fluid">
        <div class="row">
            <div class="pogoSlider" id="js-main-slider">

                @foreach ($bloque['contenido']['imagenes'] as $index => $imagen)
                        @php
                            $transiciones = ["zipReveal", "blocksReveal", "shrinkReveal"];
                            $transicion = $transiciones[array_rand($transiciones)];

                        @endphp
                        <div class="pogoSlider-slide" data-transition="{{ $transicion }}" data-duration="1500"
                            style="background-image:url({{ asset('storage/' . $imagen) }});">
                        </div>

                        <div class="lbox-caption">
                            <div class="lbox-details">
                                <h1>{{$bloque['contenido']['titulo']}}</h1>
                                {{$bloque['contenido']['subtitulo']}}
                            </div>
                        </div>
                    </div>


                @endforeach

        </div><!-- .pogoSlider -->
    </div>
</div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.pogo-slider.min.js') }}"></script>

<script>

    $(document).ready(function () {

        $('#js-main-slider').pogoSlider({
            autoplay: true,
            autoplayTimeout: 5000,
            displayProgess: true,
            preserveTargetSize: true,
            targetWidth: 1000,
            targetHeight: 300,
            responsive: true
        }).data('plugin_pogoSlider');

        var transitionDemoOpts = {
            displayProgess: false,
            generateNav: false,
            generateButtons: false
        }

    });
</script>