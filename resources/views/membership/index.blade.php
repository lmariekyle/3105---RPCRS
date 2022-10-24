@extends('layout.app')


 
@section('content')

 
    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="view-gym-members"> View Memberships </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
            {{-- for next release
            <a href="/members/create" class="add-member-bg ">
                <div class="add-member">Add Membership</div>
            </a>
            --}}
        </div>
    </div>
    <div class="GIM-membersCreate-container">
        <h3> This page will have content in the next release.</h3>
    </div>
   


@endsection