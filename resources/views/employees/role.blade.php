@extends('layout.app')

@section('employeesActive-css')

    <style>
        .employeesActive{
            background: white;
            border-radius:8px;
        }
    </style>

@endsection

@section('index-css')
        <!-- css needed for tables -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 
        <!-- my css -->
        <link rel="stylesheet" href="{{ asset('/css/index.css') }}"/>
        <link rel="stylesheet" href="{{ asset('/css/role.css') }}"/>
        <link rel="stylesheet" href="{{ asset('/css/show.css') }}"/>
        
        <style>
            table {
                border:none;
                border-collapse: collapse;
            }
            td{
                border:none;
                cursor:default;
            }
            .assignRole{
                border-left: 1px solid #000;
                border-bottom:
                /* border-right: 1px solid #000; */
            }

            table td:first-child {
                border-left: none;
            }

            table td:last-child {
                border-right: none;
            }
            
            table, tr, td, th{
                word-wrap: break-word:
            }

            table.dataTable thead th {
                border-bottom: 1px solid #111;
            }

        </style>
        <style>
            /* .tdIcon{
                text-align: right;
            } */


        </style>
@endsection


@section('content')

    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="view-gym-members">Assign Role</h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
            <a href="{{ route('employees.show', $employee->id) }}" class="add-member-bg text-sm">
                <div class="add-member">Go Back</div>
            </a>
        </div>
    </div>


<div class="show-blade-container">
    <div class="show-container w-75">
        <div class="col">
            <div class="header d-flex">
                <span class="name px-3">Name</span>
            </div>
            <div class="px-3">
                <div class="pb-3 pt-3">
                    <div class="col">
                        <h1 class="customer-name">{{ $employee->firstname}} {{ $employee->middlename[0]}}. {{ $employee->lastname}}</h1>
                    </div>
                </div>
                <table id="GIMTable" class="table " style="width:100%">
                        <thead>
                            <tr>
                            <th class="tdIcon">ID</th>
                            <th>STATUS</th>
                            <th width="12%">ROLE</th>  
                            <th> </th>
                            <th class="assignRole" >ASSIGN ROLES</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $employee->id}}</td>
                                <td>{{ $employee->status}}</td>
                                <td>
                                    @if($employee->roles)
                                        @foreach($employee->roles as $employee->role)
                                            <form method="POST" action="{{route('employees.roles.remove', [$employee->id, $employee->role->id ])}}" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                {{$employee->role->name}}
                                            </form>
                                        @endforeach
                                    @endif
                                </td>
                                <td width="10%" class="text-align: left">
                                    @if($employee->roles)
                                        @foreach($employee->roles as $employee->role)
                                            <form method="POST" action="{{route('employees.roles.remove', [$employee->id, $employee->role->id ])}}" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                        <label>
                                                        <input class="hideInput deleteUserBtn" type="submit" name="image" value="one">
                                                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                
                                                            </svg> 
                                                        </label>
                                            </form>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="assignRole" width="15%">
                                    <form class="roleForm " method="POST" action="{{ route('employees.roles', $employee->id)}}">
                                        @csrf
                                        <div class="role-selection ">
                                            <select id="role" name="role" autocomplete="role-name" class="role-input">
                                                @foreach($roles as $role)
                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('name') <span>{{$message}}</span> @enderror
                                        </div>
                                <td width="12%" class="text-align:left">
                                        <div class="role-selection btn-container ">
                                            <button type="submit" class="assignRoleBtn btn btn-primary">Assign Role</button>
                                        </div>
                                </td>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                </table>

                            <!-- <form class="roleForm " method="POST" action="{{ route('employees.roles', $employee->id)}}">
                                <div class="GIM-employeeAssignRole-Container ">
                                    <div class="GIM-employeeAssignRole-Input">
                                    @csrf
                                        <div class="roles-form ">
                                            <label for="name" class="role-name">Roles</label>
                                            <div class="role-selection">
                                                <select id="role" name="role" autocomplete="role-name" class="role-input">
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('name') <span>{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="role-selection btn-container d-flex justify-content-center">
                                            <button type="submit" class="assignRoleBtn btn btn-primary">Assign Role</button>
                                        </div>
                                    </div>
                                </div>
                            </form> -->
            </div>

        </div>
    </div>
</div>
@endsection


@section('index-js')

        <!-- javascript needed for the tables -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
        <!-- javascript external -->
        <!-- <script type="text/javascript" src="{{ URL::asset('/js/index.js') }}"></script> -->
        <script>
            $(document).ready(function () {
                $('#GIMTable').DataTable({
 
                    "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
                    "paging": false,//Dont want paging                
                    "bPaginate": false,//Dont want paging  
                    searching: false,
                    "ordering": false,
                    "language": {
                        "emptyTable": "No Employee"
                    }
                })
            });
        </script>

@endsection

@section('role-js')
            <script>
                function deleteRed() {
                    document.getElementById("demo").style.color = "red";
                }
            </script>
@endsection