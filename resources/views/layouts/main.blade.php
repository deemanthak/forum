<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/offcanvas.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="wrapper" id="app">
    @include('layouts.navbar')
    <!--========================== Contant-Area================================-->
    <div class="contant-area">
        <div class="container">
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="col-md-3 col-sm-4 col-xs-6 sidebar-offcanvas" id="sidebar">
                    <!--========================== left-sidebar ================================-->

                    @include('layouts.leftbar')
                </div>
                <!--========================== main-content ================================-->
                @yield('content')

                <!--========================== Right-Sidebar ================================-->
                @include('layouts.rightbar')

            </div>
        </div><!-- Container -->
    </div><!-- Content-area -->
    @include('layouts.footer')
<flash message="{{ session('flash') }}"></flash>
</div><!-- /Wrapper -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- development version, includes helpful console warnings -->
{{--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>--}}
<script src="{{asset('js/app.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>

</body>
</html>
