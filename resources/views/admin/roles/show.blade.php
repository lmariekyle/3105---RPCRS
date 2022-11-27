@extends('layout.app')

@section('rolesActive-css')

    <style>
        .rolesActive{
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
        <style>
            
            table.dataTable tbody tr td{
                /* or whatever height you need to make them all consistent */
            }
            table, tr, td, th{
                word-wrap: break-word;
            }
            td{
                border:none;
            }
            table.dataTable thead th {
                border-bottom: 1px solid #111;
            }
            .table-container{
                border: 1px solid #000000;
                filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
                border-radius: 10px;
            }
        </style>
@endsection

@section('content')

<div class="GIM-membersCreate" style="width: 50.6%; margin-top: 9.5%;">

    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="view-gym-members">Roles</h1>
        </div>
    </div>

    <div>
    <table id="GIMTable" class="table-container table table-hover ">
             
             <!-- thead tag starts from here -->
             <thead class="roleTableHeader">
                 <tr>
                 <th>Name</th>
                 <th>Role</th>
                 <th></th>
                 </tr>
             </thead>
             <!-- thead tag ends here -->
             <tbody class="justify-content-center" style="cursor: pointer;">
                @foreach($employees as $employee)
                 <tr>
                 <td>{{ $employee->firstname}} {{ $employee->middlename}} {{ $employee->lastname}}</td>
                 <td>
                 @if($employee->roles)
                                @foreach($employee->roles as $employee->role)                
                                        <div class="d-flex justify-content-between">
                                            <div class="role-name">{{$employee->role->name}}</div>
                                        </div>
                                    </form>
                                @endforeach
                            @endif
                </td>
                </tr>
                 @endforeach
             </tbody>
         </table>
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
                    columnDefs: [{ targets: [1,2], orderable: false }],
                    "language": {
                        "emptyTable": "No Data Available"
                    }
                })

            });
        </script>
@endsection