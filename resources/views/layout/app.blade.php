<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GIM</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css'); }} ">


        <!-- sidebar-css-js -->
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/membersCreate.css') }}" rel="stylesheet">

        <!-- fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  
        <!-- icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <script src="https://kit.fontawesome.com/5a0ab02d03.js" crossorigin="anonymous"></script>
        
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

        


        <!-- index-css -->
        @yield('gymMembersActive-css')
        @yield('employeesActive-css')
        @yield('rolesActive-css')
        @yield('permissionsActive-css')
        @yield('index-css')
        @yield('show-css')
        @yield('enroll-css')
        @yield('role-css')

        <style>
            body{
                background: #EDEDE9;
            }
        </style>

        <script src="{{asset('js/app.js')}}" defer></script>
        <script src="https://kit.fontawesome.com/5a0ab02d03.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>
        
        <div class="main-container d-flex">
        @include('layouts.navigation')
            <div class="container">
                <br>
                @include('inc.flash')
                @yield('content')
            </div>
        </div>
        
   
    <!-- sidebar-js -->
    

    <!-- index-js -->
    @yield('index-js')
    @yield('enroll-js')
    @yield('show-js')
    
    </body>
    <script>
        $(".sidebar ul li").on('click' , function(){
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        }
        )
    </script>
    @yield('scripts')
</html>
