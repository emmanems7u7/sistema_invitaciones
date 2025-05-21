<style>
    #fh5co-couple {
        padding: 2em 1em 12em;
        clear: both;
    }

    @media screen and (max-width: 768px) {

        #fh5co-couple {
            padding: 3em 0;
        }
    }

    .couple-wrap {
        width: 90%;
        margin: 0 auto;
        position: relative;
    }

    @media screen and (max-width: 768px) {
        .couple-wrap {
            width: 100%;
        }
    }

    .couple-half {
        width: 50%;
        float: left;
    }


    @media screen and (max-width: 768px) {
        .couple-half {
            width: 100%;
        }
    }

    .couple-half h3 {
        font-family: "Sacramento", Arial, serif;
        color: var(--primary);
        font-size: 30px;
    }

    .couple-half .groom,
    .couple-half .bride {
        float: left;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%;
        width: 150px;
        height: 150px;
    }

    .couple-half .groom img,
    .couple-half .bride img {
        width: 150px;
        height: 150px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%;
    }

    @media screen and (max-width: 480px) {

        .couple-half .groom,
        .couple-half .bride {
            width: 100%;
            height: 140px;
        }

        .couple-half .groom img,
        .couple-half .bride img {
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }
    }

    .couple-half .groom {
        float: right;
        margin-right: 5px;
    }

    .couple-half .bride {
        float: left;
        margin-left: 5px;
    }

    .couple-half .desc-groom {
        padding-right: 180px;
        text-align: right;
    }

    .couple-half .desc-bride {
        padding-left: 180px;
        text-align: left;
    }

    @media screen and (max-width: 480px) {

        .couple-half .groom,
        .couple-half .bride {
            margin-left: 0;
            margin-right: 0;
        }

        .couple-half .desc-groom {
            padding-right: 0;
            text-align: center;
        }

        .couple-half .desc-bride {
            padding-left: 0;
            text-align: center;
        }
    }


    .couple-half .desc-groom {
        padding-right: 180px;
        text-align: right;
    }

    @media screen and (max-width: 480px) {

        .couple-half .groom,
        .couple-half .bride {
            margin-left: 0;
            margin-right: 0;
        }

        .couple-half .desc-groom {
            padding-right: 0;
            text-align: center;
        }

        .couple-half .desc-bride {
            padding-left: 0;
            text-align: center;
        }
    }

    .heart {
        position: absolute;
        top: 4em;
        left: 0;
        right: 0;
        z-index: 99;
        animation: pulse 1s ease infinite;
    }

    .heart i {
        font-size: 20px;
        background: #fff;
        padding: 20px;
        color: var(--primary);
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%;
    }

    @media screen and (max-width: 768px) {
        .heart {
            display: none;
        }
    }

    .icon-heart:before {
        content: "\e024";
    }

    .icon-heart-outlined:before {
        content: "\e9b4";
    }

    .img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
    }

    .js .animate-box {
        opacity: 0;
    }
</style>
<div id="fh5co-couple">
    <div class="container">

        <div class="couple-wrap animate-box">

            @foreach ($bloque['contenido'] as $index => $info)
                <div class="couple-half">
                    @if ($index % 2 == 0)
                        <div class="groom">
                    @else
                        <div class="bride">
                    @endif

                            <img src="{{asset('storage/' . $info['imagen'])}}" alt="groom" class="img-responsive">
                        </div>

                        @if ($index % 2 == 0)
                            <div class="desc-groom">
                        @else
                            <div class="desc-bride">
                        @endif
                                <h3>{{$info['titulo']}}</h3>
                                <p>{{$info['subtitulo']}}</p>
                                <p>{{$info['parrafo']}}</p>
                            </div>
                        </div>

                        <p class="heart text-center"><i class="fas fa-heart"></i></p>

            @endforeach


                </div>
            </div>
        </div>

        <script>
            var contentWayPoint = function () {
                var i = 0;
                $('.animate-box').waypoint(function (direction) {

                    if (direction === 'down' && !$(this.element).hasClass('animated-fast')) {

                        i++;

                        $(this.element).addClass('item-animate');
                        setTimeout(function () {

                            $('body .animate-box.item-animate').each(function (k) {
                                var el = $(this);
                                setTimeout(function () {
                                    var effect = el.data('animate-effect');
                                    if (effect === 'fadeIn') {
                                        el.addClass('fadeIn animated-fast');
                                    } else if (effect === 'fadeInLeft') {
                                        el.addClass('fadeInLeft animated-fast');
                                    } else if (effect === 'fadeInRight') {
                                        el.addClass('fadeInRight animated-fast');
                                    } else {
                                        el.addClass('fadeInUp animated-fast');
                                    }

                                    el.removeClass('item-animate');
                                }, k * 200, 'easeInOutExpo');
                            });

                        }, 100);

                    }

                }, { offset: '85%' });
            };
        </script>