<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>MATHX</title>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        footer {
            padding: 20px 0;
        }
        main {
            margin-bottom: 100px;
        }
        @media (min-width: 1024px) {
            .o-footer--copyright {
                padding: 0 30px 0;
                border-left: 1px solid #DFDFDF;
            }
        }
        .o-footer--copyright p {
            margin-bottom: 0;
            font-size: 12px;
            line-height: 20px;
        }
        .o-footer--copyright ul li:first-child {
            border-left: 0;
            padding: 0 10px 0 0;
        }
        .o-footer--copyright ul li {
            display: inline-block;
            font-size: 12px;
            line-height: 16px;
            border-left: 1px solid #DFDFDF;
            padding: 0 10px;
            margin-bottom: 4px;
        }
        .o-footer--copyright ul li a {
            color: #414446;
        }
        .logo a{
            color: #636b6f;
            font-weight: 900;
            font-size: 25px;
            text-decoration: none;
        }
        header {
            background: #fff !important;
            box-shadow: 0 0 11px 0px rgba(0, 0, 0, 0.16);
            margin-bottom: 50px;
            padding:20px 0 ;
        }
        header .container-fluid {
            max-width: 95%;
        }
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            color: #000;
            font-weight: 500;
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
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    @include('layouts/header')

    <main>
        @yield('content')
    </main>



    @include('layouts/footer')

</body>
</html>