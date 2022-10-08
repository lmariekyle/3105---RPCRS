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
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/dashboard/home" class="nav-link text-black">
          <svg class="bi pe-none me-2" width="16" height="16"><use href="/dashboard/home"/></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="/members" class="nav-link text-black">
          <svg class="bi pe-none me-2" width="16" height="16"><use href="/members"/></svg>
          Gym Members
        </a>
      </li>
      <li>
        <a href="/employees" class="nav-link text-black">
          <svg class="bi pe-none me-2" width="16" height="16"><use href="/employees"/></svg>
          Employees
        </a>
      </li>
      <li>
        <a href="/gymclasses" class="nav-link text-black">
          <svg class="bi pe-none me-2" width="16" height="16"><use href="/gymclasses"/></svg>
          Classes
        </a>
      </li>
      <li>
        <a href="/membership" class="nav-link text-black">
          <svg class="bi pe-none me-2" width="16" height="16"><use href="/membership"/></svg>
          Membership
        </a>
      </li>
      <li class="nav-item">
      <x-admin-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">    
          <svg class="bi pe-none me-2" width="16" height="16"><use href="{{route('admin.roles.index')}}"/></svg>
          Roles
        </x-admin-link>
      </li>
      <li class="nav-item">
      <x-admin-link :href="route('admin.permissions.index')"
                    :active="request()->routeIs('admin.permissions.index')">
          <svg class="bi pe-none me-2" width="16" height="16"><use href="{{route('admin.permissions.index')}}"/></svg>
          Permissions
      </x-admin-link>
      </li>
    </ul>
    <hr>

    <div class="admin-body">
        {{$slot}} <!--admin.index -->
    </div>
    </body>
</html>
