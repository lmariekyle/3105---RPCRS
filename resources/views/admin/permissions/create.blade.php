@extends('layouts.app')

<x-admin-layout>

        <!-- css needed for tables -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 
        <!-- my css -->
        <link rel="stylesheet" href="{{ asset('/css/index.css') }}"/>
        <link rel="stylesheet" href="{{ asset('/css/role.css') }}"/>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <h1>Roles</h1>
                    </div>
                    <div class="role-create-btn-container">
                        <a href="{{route('admin.permissions.index')}}">View Permissions</a>
                    </div>
            </div> -->

<div class="GIM-membersCreate" style="width: 50.6%; margin-top: 9.5%;">
    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="view-gym-members">Add Permission</h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
            <a href="{{route('admin.permissions.index')}}" class="add-member-bg text-sm">
                <div class="add-member">Back</div>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.permissions.store') }}">
        <div class="GIM-roleContainer">
            <div class="GIM-roleContainer-input">
                <div class="GIM-membersCreate-formAllignment">
                    @csrf
                    <div class="permissions-form">
                        <label for="name" class="role-name">Permission Name</label>
                        <div class="role-input">
                            <input type="text" id="name" name="name">
                        </div>
                        @error('name') <span>{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="GIM-membersCreate-formAllignment">
                    <div class="permissionButton">
                        <button type="submit" class="btn-design">Create Permission</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-admin-layout>
<style>
        .permissionsActive{
            background: white;
            border-radius:8px;
        }
</style>
