<x-app-layout>
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}"/>
    <script src="{{asset('js/app.js')}}" defer></script>
    <x-slot name="header">
        <div class="my-custom-row d-flex flex-row justify-content-between " >
            @role('admin')
            <div class="admin-container">
                <h1 class="adminText"> {{ __('Hello, Admin') }} </h1>
            </div>
            @endrole
            @role('employee')
            <div class="admin-container">
                <h1 class="adminText"> {{ __('Hello, Employee') }} </h1>
            </div>
            @endrole
            

        </div>
            <div class="contentContainer">
                <div class="centerContainer">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <a href="/employees">
                                <div class="box">
                                    <i class="Iicons fa-solid fa-id-card"></i>
                                    <!-- <svg class="SVGicons" xmlns="http://www.w3.org/2000/svg" width="169" height="169" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>-->
                                </div>
                            </a>
                            <div class="box-description">
                                EMPLOYEES
                            </div>
                        </div>
                        <div class="">
                            <a href="/members">
                                <div class="box">
                                    <i class="Iicons fa-solid fa-users"></i>
                                </div>
                            </a>
                            <div class="box-description">
                                GYM MEMBERS
                            </div>
                        </div>
                        <div class="">
                            <a href="/gymclass">
                                <div class="box">
                                    <!-- <svg class="SVGicons" xmlns="http://www.w3.org/2000/svg" width="169" height="169" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg> -->
                                    <i class="Iicons fa-solid fa-dumbbell"></i>
                                </div>
                            </a>
                            <div class="box-description">
                                CLASSES
                            </div>
                        </div>
                        <div class="">
                            <a href="/membership">
                                <div class="box">
                                    <i class="Iicons fa-solid fa-address-book"></i>
                                    <!-- <i class='Iicons fas fa-chalkboard'></i> -->
                                </div>
                            </a>
                            <div class="box-description">
                                MEMBERSHIP
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </x-slot>

</x-app-layout>
<style>
        .dashboardActive{
            background: white;
            border-radius:8px;
        }
</style>