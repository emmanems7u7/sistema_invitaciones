@if(isset($bloque['contenido']))
    <style>
        /*------------------------------------------------------------------
                                                                                                                        Story
                                                                                                                    -------------------------------------------------------------------*/

        .story-box {
            padding: 0px 0px;
        }

        .align-left {
            text-align: left;
        }

        .align-right {
            text-align: right;
        }

        .main-timeline-box {
            position: relative;
            word-wrap: break-word;
        }

        .main-timeline-box .timeline-element {
            margin-bottom: 50px;
            position: relative;
            word-wrap: break-word;
            word-break: break-word;
            display: -webkit-flex;
            flex-direction: row;
            -webkit-flex-direction: row;
        }

        .main-timeline-box .reverse {
            flex-direction: row-reverse;
            -webkit-flex-direction: row-reverse;
        }

        .main-timeline-box .separline::before {
            top: 20px;
            bottom: 0;
            position: absolute;
            content: "";
            width: 2px;
            background-color: #f1f1f1;
            left: calc(50% - 1px);
            height: calc(100% + 4rem);
        }

        .main-timeline-box .iconBackground {
            position: absolute;
            left: 50%;
            width: 20px;
            height: 20px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            font-size: 30px;
            display: inline-block;
            background-color: #f1f1f1;
            top: 20px;
            margin-left: -10px;
        }

        .main-timeline-box .timeline-text-content {
            padding: 30px 35px;
            background: #f1f1f1;
        }

        .main-timeline-box .reverse .timeline-text-content {
            margin-right: 30px;
        }

        .main-timeline-box .reverse .time-line-date-content p {
            float: left;
            padding: 30px 35px;
            background: #f1f1f1;
        }

        .main-timeline-box .reverse .time-line-date-content {
            margin-right: 30px;
        }

        .display-font {
            font-family: 'Engagement', cursive;
            font-size: 30px;
            color: #222222;
        }

        .main-timeline-box .timeline-text-content {
            margin-left: 30px;
        }

        .main-timeline-box .time-line-date-content p {
            float: right;
            padding: 30px 35px;
            background: #f1f1f1;
        }

        .main-timeline-box .time-line-date-content {
            margin-right: 30px;
        }

        .main-timeline-box .time-line-date-content .mbr-timeline-date {
            background: #881228;
            color: #ffffff;
        }

        .main-timeline-box .reverse .time-line-date-content .mbr-timeline-date {
            background: #63c7bd;
            color: #ffffff;
        }

        .title h2 {
            font-size: 1.2em;
            color: #ffffff;
            padding: 10px 0px;
        }

        .lead {
            font-size: 1em;
            text-align: justify;
        }
    </style>

    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
    <div id="story" class="story-box main-timeline-box">
        <div class="container">

            <div class="timeLine">
                <div class="row">
                    <div class="lineHeader hidden-sm hidden-xs"></div>
                    <div class="lineFooter hidden-sm hidden-xs"></div>

                    @foreach ($bloque['contenido'] as $index => $info)

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">
                            <div class="caption">
                                <div class="star center-block">
                                    <span>{{$info['subtitulo']}}</span>
                                </div>
                                <div class="image">
                                    <img src="{{ asset('storage/' . $info['imagen']) }}" alt="" />
                                    <div class="title">
                                        <h2>{{$info['titulo']}} <i class="fa fa-angle-right" aria-hidden="true"></i></h2>
                                    </div>
                                </div>
                                <div class="textContent">
                                    <p class="lead">{{$info['parrafo']}}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('js/responsiveslides.min.js') }}"></script>
    <script src="{{ asset('js/timeLine.min.js') }}"></script>

    <script>
        // Obtener el valor de la variable CSS --secondary
        var secondaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary').trim();


        $('.timeLine').timeLine({
            mainColor: secondaryColor,
            opacity: '0.85',
            lineColor: secondaryColor
        });

    </script>
@endif