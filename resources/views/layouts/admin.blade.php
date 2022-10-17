<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/membersCreate.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{asset('js/app.js')}}" defer></script>
    </head>
    <body class="font-sans antialiased">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-black text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32"></svg>
      <span class="fs-4">Sidebar</span>
    </a>

    <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-black-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>

    <hr>
    <div class="content" id="side_nav">
        <span class="main-container d-flex">
        <div class="sidebar m-2">
            <div class="header-box px-2 pt-3 pb-4">
                <h1 class="fs-4 d-flex justify-content-center">
                    <!-- <span class="bg-white text-dark rounded shadow px-2 me-2">CL</span> -->
                    <span class="GIM">GIM</span>
                </h1>
                <!-- <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button> -->
                <ul class="list-unstyled px-2">
                <li class="d-flex justify-content-center" >
                    <a href="/dashboard" class="text-decoration-none py-2 d-block">
                        <div class="d-flex justify-content-center">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <div class="GIMText">
                            Dashboard
                        </div>
                    </a>
                </li>
                <div class="space"></div>
                <li class="active d-flex justify-content-center">
                    <a href="/members" class="text-decoration-none py-2 d-block">
                        <div class="d-flex justify-content-center">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <div class="GIMText">
                            Gym Members
                        </div>
                    </a>
                </li>
                <div class="space"></div>
                <li class="d-flex justify-content-center">
                    <a href="/employees" class="text-decoration-none py-2 d-block">
                        <div class="d-flex justify-content-center">
                            <i class="fa-solid fa-user" ></i>
                        </div>
                        <div class="GIMText">
                            Employees
                        </div>
                    </a>
                </li>
                <div class="space"></div>
                <li class="d-flex justify-content-center">
                    <a href="/classes" class="text-decoration-none py-2 d-block">
                        <div class="d-flex justify-content-center">
                            <i class="fa-solid fa-chalkboard"></i>
                        </div>
                        <div class="GIMText">
                            Classes
                        </div>
                    </a>
                </li>
                <div class="space"></div>
                <li class="d-flex justify-content-center">
                    <a href="/membership" class="text-decoration-none py-2 d-block">
                    <div class="d-flex justify-content-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="GIMText">
                        Membership
                    </div>
                    </a>
                </li>
                </ul>
            </div>
        </div>
        </span>
    </div>
  

    <hr>

    <div class="admin-body">
        {{$slot}} <!--admin.index -->
    </div>
    </body>
</html>
