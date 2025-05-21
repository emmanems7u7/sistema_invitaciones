@if(isset($bloque['contenido']))
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">

    <style>
        #fh5co-header .display-tc,
        #fh5co-counter .display-tc,
        .fh5co-cover .display-tc {
            display: table-cell !important;
            vertical-align: middle;
        }

        #fh5co-header .display-tc h1,
        #fh5co-header .display-tc h2,
        #fh5co-counter .display-tc h1,
        #fh5co-counter .display-tc h2,
        .fh5co-cover .display-tc h1,
        .fh5co-cover .display-tc h2 {
            margin: 0;
            padding: 0;
            color: white;
        }

        #fh5co-header .display-tc h1,
        #fh5co-counter .display-tc h1,
        .fh5co-cover .display-tc h1 {
            margin-bottom: 0px;
            font-size: 100px;
            line-height: 1.5;
            font-family: var(--fuente), Arial, serif;
        }

        @media screen and (max-width: 768px) {

            #fh5co-header .display-tc h1,
            #fh5co-counter .display-tc h1,
            .fh5co-cover .display-tc h1 {
                font-size: 40px;
            }
        }

        @media screen and (max-width: 480px) {

            #fh5co-header .display-tc h1,
            #fh5co-counter .display-tc h1,
            .fh5co-cover .display-tc h1 {
                font-size: 30px;
            }
        }

        #fh5co-header .display-tc h2,
        #fh5co-counter .display-tc h2,
        .fh5co-cover .display-tc h2 {
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        @media screen and (max-width: 480px) {

            #fh5co-header .display-tc h2,
            #fh5co-counter .display-tc h2,
            .fh5co-cover .display-tc h2 {
                font-size: 16px;
            }
        }

        #fh5co-header .display-tc .btn,
        #fh5co-counter .display-tc .btn,
        .fh5co-cover .display-tc .btn {
            padding: 15px 20px;
            background: #fff !important;
            color: #F14E95;
            border: none !important;
            font-size: 14px;
            text-transform: uppercase;
        }

        #fh5co-header .display-tc .btn:hover,
        #fh5co-counter .display-tc .btn:hover,
        .fh5co-cover .display-tc .btn:hover {
            background: #fff !important;
            -webkit-box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
            -moz-box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
            box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
        }

        .fh5co-video .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            -webkit-transition: 0.5s;
            -o-transition: 0.5s;
            transition: 0.5s;
        }

        .fh5co-video:hover .overlay {
            background: rgba(0, 0, 0, 0.7);
        }

        .fh5co-cover .overlay {
            z-index: 0;
            position: absolute;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        #fh5co-counter .overlay,
        #fh5co-event .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
        }

        #fh5co-started .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
        }

        .fh5co-cover .display-t,
        .fh5co-cover .display-tc {
            height: 900px;
            display: table;
            width: 100%;
        }

        @media screen and (max-width: 768px) {

            .fh5co-cover .display-t,
            .fh5co-cover .display-tc {
                height: 600px;
            }
        }

        .fh5co-cover.fh5co-cover-sm {
            height: 600px;
        }

        @media screen and (max-width: 768px) {
            .fh5co-cover.fh5co-cover-sm {
                height: 400px;
            }
        }

        .fh5co-cover.fh5co-cover-sm .display-t,
        .fh5co-cover.fh5co-cover-sm .display-tc {
            height: 600px;
            display: table;
            width: 100%;
        }

        @media screen and (max-width: 768px) {

            .fh5co-cover.fh5co-cover-sm .display-t,
            .fh5co-cover.fh5co-cover-sm .display-tc {
                height: 400px;
            }
        }

        #fh5co-counter,
        #fh5co-event {
            height: 850px;
            float: left;
        }

        #fh5co-counter .display-t,
        #fh5co-counter .display-tc,
        #fh5co-event .display-t,
        #fh5co-event .display-tc {
            height: 700px;
            display: table;
            width: 100%;
        }

        @media screen and (max-width: 768px) {

            #fh5co-counter,
            #fh5co-event {
                height: inherit;
                padding: 7em 0;
            }

            #fh5co-counter .display-t,
            #fh5co-counter .display-tc,
            #fh5co-event .display-t,
            #fh5co-event .display-tc {
                height: inherit;
            }
        }

        #fh5co-header .display-tc,
        #fh5co-counter .display-tc,
        .fh5co-cover .display-tc {
            display: table-cell !important;
            vertical-align: middle;
        }

        #fh5co-header .display-tc h1,
        #fh5co-header .display-tc h2,
        #fh5co-counter .display-tc h1,
        #fh5co-counter .display-tc h2,
        .fh5co-cover .display-tc h1,
        .fh5co-cover .display-tc h2 {
            margin: 0;
            padding: 0;
            color: white;
        }

        #fh5co-header .display-tc h1,
        #fh5co-counter .display-tc h1,
        .fh5co-cover .display-tc h1 {
            margin-bottom: 0px;
            font-size: 100px;
            line-height: 1.5;
            font-family: var(--fuente), Arial, serif;
        }

        @media screen and (max-width: 768px) {

            #fh5co-header .display-tc h1,
            #fh5co-counter .display-tc h1,
            .fh5co-cover .display-tc h1 {
                font-size: 40px;
            }
        }

        @media screen and (max-width: 480px) {

            #fh5co-header .display-tc h1,
            #fh5co-counter .display-tc h1,
            .fh5co-cover .display-tc h1 {
                font-size: 30px;
            }
        }

        #fh5co-header .display-tc h2,
        #fh5co-counter .display-tc h2,
        .fh5co-cover .display-tc h2 {
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        @media screen and (max-width: 480px) {

            #fh5co-header .display-tc h2,
            #fh5co-counter .display-tc h2,
            .fh5co-cover .display-tc h2 {
                font-size: 16px;
            }
        }

        #fh5co-header .display-tc .btn,
        #fh5co-counter .display-tc .btn,
        .fh5co-cover .display-tc .btn {
            padding: 15px 20px;
            background: #fff !important;
            color: #F14E95;
            border: none !important;
            font-size: 14px;
            text-transform: uppercase;
        }

        #fh5co-header .display-tc .btn:hover,
        #fh5co-counter .display-tc .btn:hover,
        .fh5co-cover .display-tc .btn:hover {
            background: #fff !important;
            -webkit-box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
            -moz-box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
            box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
        }

        .fh5co-cover .display-t,
        .fh5co-cover .display-tc {
            height: 900px;
            display: table;
            width: 100%;
        }

        #fh5co-counter .display-t,
        #fh5co-counter .display-tc,
        #fh5co-event .display-t,
        #fh5co-event .display-tc {
            height: 700px;
            display: table;
            width: 100%;
        }

        @media screen and (max-width: 768px) {

            #fh5co-counter,
            #fh5co-event {
                height: inherit;
                padding: 7em 0;
            }

            #fh5co-counter .display-t,
            #fh5co-counter .display-tc,
            #fh5co-event .display-t,
            #fh5co-event .display-tc {
                height: inherit;
            }
        }

        #fh5co-header .display-tc,
        #fh5co-counter .display-tc,
        .fh5co-cover .display-tc {
            display: table-cell !important;
            vertical-align: middle;
        }

        #fh5co-header .display-tc h1,
        #fh5co-header .display-tc h2,
        #fh5co-counter .display-tc h1,
        #fh5co-counter .display-tc h2,
        .fh5co-cover .display-tc h1,
        .fh5co-cover .display-tc h2 {
            margin: 0;
            padding: 0;
            color: white;
        }

        #fh5co-header .display-tc h1,
        #fh5co-counter .display-tc h1,
        .fh5co-cover .display-tc h1 {
            margin-bottom: 0px;
            font-size: 100px;
            line-height: 1.5;
            font-family: var(--fuente), Arial, serif;
        }

        @media screen and (max-width: 768px) {

            #fh5co-header .display-tc h1,
            #fh5co-counter .display-tc h1,
            .fh5co-cover .display-tc h1 {
                font-size: 40px;
            }
        }

        @media screen and (max-width: 480px) {

            #fh5co-header .display-tc h1,
            #fh5co-counter .display-tc h1,
            .fh5co-cover .display-tc h1 {
                font-size: 30px;
            }
        }

        #fh5co-header .display-tc h2,
        #fh5co-counter .display-tc h2,
        .fh5co-cover .display-tc h2 {
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        @media screen and (max-width: 480px) {

            #fh5co-header .display-tc h2,
            #fh5co-counter .display-tc h2,
            .fh5co-cover .display-tc h2 {
                font-size: 16px;
            }
        }

        #fh5co-header .display-tc .btn,
        #fh5co-counter .display-tc .btn,
        .fh5co-cover .display-tc .btn {
            padding: 15px 20px;
            background: #fff !important;
            color: #F14E95;
            border: none !important;
            font-size: 14px;
            text-transform: uppercase;
        }

        #fh5co-header .display-tc .btn:hover,
        #fh5co-counter .display-tc .btn:hover,
        .fh5co-cover .display-tc .btn:hover {
            background: #fff !important;
            -webkit-box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
            -moz-box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
            box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
        }

        .js .animate-box {
            opacity: 0;
        }

        .simply-countdown {
            /* The countdown */
            margin-bottom: 2em;
        }

        .simply-countdown>.simply-section {
            /* coutndown blocks */
            display: inline-block;
            width: 100px;
            height: 100px;
            background: var(--primary_rgba);
            margin: 0 4px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            border-radius: 50%;
            position: relative;
            animation: pulse 1s ease infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .simply-countdown>.simply-section>div {
            /* countdown block inner div */
            display: table-cell;
            vertical-align: middle;
            height: 100px;
            width: 100px;
        }

        .simply-countdown>.simply-section .simply-amount,
        .simply-countdown>.simply-section .simply-word {
            display: block;
            color: white;
            /* amounts and words */
        }

        .simply-countdown>.simply-section .simply-amount {
            font-size: 30px;
            /* amounts */
        }

        .simply-countdown>.simply-section .simply-word {
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            font-size: 12px;
            /* words */
        }

        .fh5co-cover {
            height: 789px;
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
            width: 100%;
        }

        .fh5co-cover .overlay {
            z-index: 0;
            position: absolute;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .fh5co-cover>.fh5co-container {
            position: relative;
            z-index: 10;
        }

        @media screen and (max-width: 768px) {
            .fh5co-cover {
                height: 600px;
            }
        }

        .fh5co-cover .display-t,
        .fh5co-cover .display-tc {
            height: 900px;
            display: table;
            width: 100%;
        }

        @media screen and (max-width: 768px) {

            .fh5co-cover .display-t,
            .fh5co-cover .display-tc {
                height: 600px;
            }
        }

        .fh5co-cover.fh5co-cover-sm {
            height: 600px;
        }

        @media screen and (max-width: 768px) {
            .fh5co-cover.fh5co-cover-sm {
                height: 400px;
            }
        }

        .fh5co-cover.fh5co-cover-sm .display-t,
        .fh5co-cover.fh5co-cover-sm .display-tc {
            height: 747;
            display: table;
            width: 100%;
        }

        @media screen and (max-width: 768px) {

            .fh5co-cover.fh5co-cover-sm .display-t,
            .fh5co-cover.fh5co-cover-sm .display-tc {
                height: 400px;
            }
        }

        #fh5co-header .display-tc,
        #fh5co-counter .display-tc,
        .fh5co-cover .display-tc {
            display: table-cell !important;
            vertical-align: middle;
        }

        #fh5co-header .display-tc h1,
        #fh5co-header .display-tc h2,
        #fh5co-counter .display-tc h1,
        #fh5co-counter .display-tc h2,
        .fh5co-cover .display-tc h1,
        .fh5co-cover .display-tc h2 {
            margin: 0;
            padding: 0;
            color: white;
        }

        #fh5co-header .display-tc h1,
        #fh5co-counter .display-tc h1,
        .fh5co-cover .display-tc h1 {
            margin-bottom: 0px;
            font-size: 100px;
            line-height: 1.5;
            font-family: var(--fuente), Arial, serif;
        }

        @media screen and (max-width: 768px) {

            #fh5co-header .display-tc h1,
            #fh5co-counter .display-tc h1,
            .fh5co-cover .display-tc h1 {
                font-size: 40px;
            }
        }

        @media screen and (max-width: 480px) {

            #fh5co-header .display-tc h1,
            #fh5co-counter .display-tc h1,
            .fh5co-cover .display-tc h1 {
                font-size: 30px;
            }
        }

        #fh5co-header .display-tc h2,
        #fh5co-counter .display-tc h2,
        .fh5co-cover .display-tc h2 {
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        @media screen and (max-width: 480px) {

            #fh5co-header .display-tc h2,
            #fh5co-counter .display-tc h2,
            .fh5co-cover .display-tc h2 {
                font-size: 16px;
            }
        }

        #fh5co-header .display-tc .btn,
        #fh5co-counter .display-tc .btn,
        .fh5co-cover .display-tc .btn {
            padding: 15px 20px;
            background: #fff !important;
            color: #F14E95;
            border: none !important;
            font-size: 14px;
            text-transform: uppercase;
        }

        #fh5co-header .display-tc .btn:hover,
        #fh5co-counter .display-tc .btn:hover,
        .fh5co-cover .display-tc .btn:hover {
            background: #fff !important;
            -webkit-box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
            -moz-box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
            box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75) !important;
        }

        .display-tc h1 {
            font-size: 62px !important;
            line-height: 1.5;
            font-family: var(--fuente), Arial, serif;
        }

        @media screen and (max-width: 480px) {
            .display-tc h1 {
                font-size: 47px !important;

            }
        }
    </style>

    @foreach ($bloque['contenido'] as $index => $hora)
        <header id="fh5co-header" class="fh5co-cover mt-3" role="banner"
            style="background-image: url('{{ asset('storage/' . $hora['imagen']) }}');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">

                <div class="col-md-12 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>{{$hora['titulo']}}</h1>
                            <h2>{{$hora['subtitulo']}}</h2>
                            <div class="simply-countdown simply-countdown-one"></div>

                        </div>
                    </div>
                </div>

            </div>
        </header>
    @endforeach

    <script src="{{ asset('js/simplyCountdown.js') }}"></script>
    <script>
        var fechaHora = '{{ $bloque['fechaHora']}}';
        // Crear una nueva fecha con año, mes, día, hora, minuto y segundo
        var d = new Date(fechaHora);


        // default example
        simplyCountdown('.simply-countdown-one', {
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate()
        });

        //jQuery example
        $('#simply-countdown-losange').simplyCountdown({
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate(),
            enableUtc: false,

        });
    </script>
@endif