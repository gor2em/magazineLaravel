<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{ url('assets/admin/assets/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ url('assets/admin/assets/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{ url('assets/admin/assets/css/custom.css') }}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>



    <div id="wrapper">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="{{ url('assets/admin/assets/img/logo.png') }}" />
                    </a>
                </div>

                <span class="logout-spn">
                    <a href="{{ url('logout') }}" style="color:#fff;font-size:20px">LOGOUT</a>
                </span>
                <span class="logout-spn">
                    <a href="{{ url('/') }}" style="color:#fff;font-size:20px">VIEW WEBSITE</a>
                </span>

                @auth
                    {{-- <?= print_r(Auth::user()) ?>  user is object --}}
                    <span style="color:white">Hi, {{Auth::user()->name}} <br> {{Auth::user()->email}}</span>
                @endauth

            </div>
        </div>
