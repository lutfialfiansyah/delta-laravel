<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Megatrend.co.id</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .text {
                font-size: 20px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .toright {
                text-align: right;
                right: 50px;
            }
        </style>
    </head>
    <body>
    <div class="flex-center position-ref full-height">
            <!-- BEGIN CONTENT -->
            <div class="content">
                <div class="text">
                    <a>PT MEGATREND</a>
                </div>
                <div class="title m-b-md">
                    Neraca (Standar)
                </div>

            </div>
            @yield('content')
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        {{--<div><br>--}}
            {{--<div class="page-footer-inner"> 2016 &copy; Metronic Theme By</div>--}}
        {{--</div>--}}
        <!-- END FOOTER -->
    </div>
    </body>
</html>
