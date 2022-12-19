@extends('layout.app')

@section('employeesActive-css')

    <style>
        .classesActive{
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


@section('index-css')
        <!-- css needed for tables -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 
        <!-- my css -->
        <link rel="stylesheet" href="{{ asset('/css/index.css') }}"/>
        <link rel="stylesheet" href="{{ asset('/css/role.css') }}"/>
        <link rel="stylesheet" href="{{ asset('/css/show.css') }}"/>
        
        <style>
            body{
                word-wrap: break-word:
            }
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


@section('content')

    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="view-gym-members">Assign Instructor</h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
            <a href="/gymclass/{{$gymclass->id}}" class="add-member-bg text-sm">
                <div class="add-member">Go Back</div>
            </a>
        </div>
    </div>


<div class="show-blade-container">
    <div class="show-container w-75">
        <div class="col">
            <div class="header d-flex">
                <span class="name px-3">Class Name</span>
            </div>
            <div class="px-3">
                <div class="pb-3 pt-3">
                    <div class="col">
                        <h1 class="customer-name">{{$gymclass->name}}</h1>
                    </div>
                    <div>
                        {{$gymclass->description}}
                    </div>
                </div>
                <table id="GIMTable" class="table-container table table-stripped" style="width:100%">
                        <thead>
                            <tr>
                                <th>CLASS ID</th>
                                <th>STATUS</th>
                                <th>SCHEDULE</th>  
                                <th style="text-align: right">
                                    <div class="col">Instructor</div> 
                                    <div class="col">Assigned</div>
                                </th> 
                                <th></th>
                                <th>Instructor List</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$gymclass->id}}</td>
                                <td>{{$gymclass->status}}</td>
                                <td>({{$gymclass->schedule}}) {{$gymclass->time}}</td>
                                <td width="12%" style="text-align: right">
                                    @if($gymdetails->count())                                    
                                        @foreach($instructors as $instructor)
                                        <form method="POST" action="{{route('staffdetails.destroy', $instructor->employee_id)}}">
                                            @csrf
                                        {{$instructor->employeefirstname}} {{$instructor->employeelastname}} 
                                            
                                        </form>                                
                                        @endforeach
                                        @endif
                                </td>
                                
                                <td width="10%" style="text-align: left">
                                @if($gymdetails->count())                                    
                                @foreach($instructors as $instructor)
                                    <form method="POST" action="{{route('staffdetails.destroy', $instructor->employee_id)}}">
                                            @csrf
                                            @method('DELETE')

                                    <label>
                                        <input class="hideInput deleteUserBtn" type="submit" name="image" value="one">
                                        <span id="deletePopover" data-toggle="popover-hover" data-container="body" title="Remove Instructor" data-content="">
                                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg> 
                                        </span>
                                    </label>
                                    </form>                    
                                    @endforeach
                                    @else
                                    None
                                    @endif              
                                </td>
                                            


                                
                                <td class="assignRole" width="15%" style="text-align: right">
                                    <form  method="POST" action="{{ route('staffdetails.store', $gymclass->id)}}">
                                        @csrf
                                        <div>
                                            <input type="text" name="class_id" value="{{$gymclass->id}}" hidden>    
                                            <select name="employee_id">
                                            
                                            @foreach ($employees as $employee) 
                                                   <option value="{{$employee->id}}">{{$employee->firstname}} {{$employee->lastname}}</option>
                                            @endforeach
                                         
                                            </select>                                     
                                        </div>
                                </td>
                                
                                <td width="12%" style="text-align: right">
                                        <div class="role-selection btn-container ">
                                            <button type="submit" class="assignRoleBtn btn btn-primary">Assign Instructor</button>
                                        </div>
                                    </form> 
                                </td>
                                    
                            </tr>
                        </tbody>
                </table>

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

        <script>
            $(function () {
                $('[data-toggle="popover-hover"]').popover({
                    trigger: 'hover',
                    content: '',
                });
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