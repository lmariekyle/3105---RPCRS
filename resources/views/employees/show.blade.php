@extends('layout.app')


@section('employeesActive-css')

    <style>
        .employeesActive{
            background: white;
            border-radius:8px;
        }
    </style>

@endsection

@section('popover-css')
    <style>
        .popover-header{
            background-color: white; 
            color: black; 
            text-align:center;
        }

        .popover-body {
            color: black;
            font-size: 28px;
        }
    </style>
@endsection

@section('show-css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/css/show.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/gymMembersActive.css') }}"/>

<style>
tr, th, td,{
    border:none;
    background-color:white; 
    box-shadow:none;
}
table.dataTable thead th {
    /* border: none; */
}
 
table.dataTable tbody td {
    border:none;
}
 
table.dataTable tbody tr {
    border:none;
}
</style>

        <style>
            /* .tdIcon{
                text-align: right;
            } */
        </style>
@endsection

@section('content')
<div class="show-blade-container">
    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="head-title"> Employee Profile </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/employees" class="go-back-bg ">
                    <div class="go-back">View Employees</div>
                </a>
        </div>

    </div>
    <div class="show-container">
        <div class="col">
            <div class="header d-flex">
                <span class="name px-3">Name</span>
            </div>
            <div class="px-3">
                <div class="pb-3 pt-3">
                    <div class="col">
                        <h1 class="employee-name">{{$employee->firstname}} {{$employee->middlename[0]}}. {{$employee->lastname}}</h1>
                    </div>

                </div>
                <table id="first-table" class="table " style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>STATUS</th>
                                <th>DATE OF BIRTH</th>
                                <th>PHONE NUMBER</th>
                                <th>EMAIL</th>
                                <th>Role</th>
                                <th></th>
                                <th></th>
                                @role('SuperAdmin')
                                <th></th>
                                @endrole
                                @role('Admin')
                                <th></th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $employee->id}}</td>
                                @if($employee->status=="ACTIVE")
                                    <td style="color:green">{{ $employee->status}}</td>
                                @else
                                    <td style="color:red">{{ $employee->status}}</td>
                                @endif
                                <td>{{ $employee->date_of_birth}}</td>
                                <td>{{ $employee->phone_number}}</td>
                                <td>{{ $employee->email}}</td>
                                <td width="12%">
                                    @if($employee->roles)
                                        @foreach($employee->roles as $employee->role)                
                                                <div class="d-flex justify-content-between">
                                                    <div class="role-name">{{$employee->role->name}}</div>
                                                </div>                                       
                                        @endforeach
                                    @endif
                                </td>
                                <td class="tdIcon">
                                <span id="deletePopover" data-toggle="popover-hover" data-container="body" title="Add Role" data-content="">
                                    <a href="{{ route('employees.viewEmployee', $employee->id) }}">
                                    <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                        <!-- <button type="button" class=" p-1">ROLE</button> -->
                                    </a>
                                </span>
                                </td>
                                
                                <td class="tdIcon">
                                <span id="editPopover" data-toggle="popover-hover" data-container="body" title="Edit Employee" data-content="">
                                    <a href="/employees/{{$employee->id}}/edit">
                                        <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </a>
                                </span>
                                </td>

                                @role('SuperAdmin')
                                <td class="deleteTD tdIcon">
                                    <label class="removeInput">
                                    <span id="deletePopover" data-toggle="popover-hover" data-container="body" title="Delete Employee" data-content="">
                                        <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </span>
                                        <input class="hideInput deleteUserBtn" type="button" name="delete" value="{{$employee->id}}">
                                    </label>
                                </td>
                                @endrole

                            
                                @role('Admin')
                                <td class="deleteTD tdIcon">
                                    <label class="removeInput">
                                    <span id="deletePopover" data-toggle="popover-hover" data-container="body" title="Delete Employee" data-content="">
                                        <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </span>
                                        <input class="hideInput deleteUserBtn" type="button" name="delete" value="{{$employee->id}}">
                                    </label>
                                </td>
                                @endrole
                            </tr>
                        </tbody>
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    {!! Form::open(['action' => ['EmployeeController@destroy', $employee->id],'method'=>'POST','class' => '']) !!}
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Employee</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="employee_delete_id" id="employee_id">
                                        <h5>Delete this employee?<br> All information stored on this employee will be deleted</h5>
                                        </div>
                                        <div class="modal-footer">
                                            {{Form::hidden('_method','DELETE')}}
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                        </div>
                                    {!! Form::close() !!}
                              </div>
                            </div>
                        </div>
                </table>
 
                
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('show-js')
        <!-- javascript needed for the tables -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

        <script>
                $('#first-table').DataTable({
                    "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
                    "paging": false,//Dont want paging                
                    "bPaginate": false,//Dont want paging  
                    searching: false,
                    "ordering": false,
                    // columnDefs: [{ targets: [0,1,2,3,4,5,6,7,8,9], orderable: false }],
                    "language": {
                        "emptyTable": "Costumer does not exist."
                    }
                });
              
        </script>


        <script>
            $(function () {
                $('[data-toggle="popover-hover"]').popover({
                    trigger: 'hover',
                    content: '',
                });
            });
        </script>
@endsection


@section('scripts')

        <script>
            $(document).ready(function(){
                $('.deleteUserBtn').click(function(e){
                    e.preventDefault();
                    var employee_id = $(this).val();
                    $('#employee_id').val(employee_id);
                    $('#deleteModal').modal('show');
                });
            });
        
        </script>

@endsection