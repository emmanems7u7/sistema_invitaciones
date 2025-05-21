<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">

<!-- Start Gallery -->
<style>
    /*------------------------------------------------------------------
    Gallery
-------------------------------------------------------------------*/

    .gallery-box {
        padding: 70px 0px;
    }

    .gallery-box ul {}

    .gallery-box ul li {
        position: relative;
        width: 25%;
        margin: 0;
        padding: 0px 15px;
        float: left;
        border: none;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .gallery-box ul li a {
        position: relative;
        display: inline-block;
        border: 4px solid #ffffff;
    }

    .gallery-box ul li a::before {
        content: "";
        position: absolute;
        background: rgb(137 137 137 / 71%);
        width: 100%;
        height: 100%;
        left: 0px;
        top: 100%;
        opacity: 0;
        transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
    }

    .gallery-box ul li a .overlay {
        background: var(--primary);
        color: #ffffff;
        font-size: 22px;
        text-align: center;
        width: 38px;
        height: 38px;
        display: inline-block;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
    }

    .gallery-box ul li a:hover::before {
        top: 0;
        opacity: 1;
    }

    .gallery-box ul li a:hover .overlay {
        opacity: 1;
    }

    .gallery-box ul li a:hover {
        border: 4px solid var(--primary);
    }

    .mfp-gallery .mfp-image-holder .mfp-figure {
        cursor: pointer;
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .gallery-box ul li {
            width: 33.33%;
        }
    }

    /* mobile or only mobile */
    @media (max-width: 767px) {
        .gallery-box ul li {
            width: 50%;
        }
    }
</style>

<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/responsiveslides.min.js') }}"></script>

<div id="gallery" class="gallery-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-box">
                    <h2>{{$bloque['subtitulo']}}</h2>
                    <p>{{$bloque['titulo']}} </p>
                </div>
            </div>
        </div>
        <div class="row">
            <ul class="popup-gallery clearfix">
                @foreach ($bloque['contenido'] as $index => $contenido)
                    <li>
                        <a href="{{asset('storage/' . $contenido['imagen'])}}">
                            <img class="img-fluid" src="{{asset('storage/' . $contenido['imagen'])}}" alt="single image">
                            <span class="overlay"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        </a>
                    </li>

                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>

    /* ..............................................
    Gallery
    ................................................. */

    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },

    });


</script>
<!-- End Gallery -->