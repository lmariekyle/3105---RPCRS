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
        <style>
            
            table.dataTable tbody tr td{
                /* or whatever height you need to make them all consistent */
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

    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="view-gym-members"> View Employees </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
            <a href="{{ route('employees.create') }}" class="add-member-bg text-sm">
                <div class="add-member">Add Employee</div>
            </a>
        </div>
    </div>
    <div class="cont-table">
        <table id="GIMTable" class="table-container table table-hover ">
       
            <thead>
               
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE NUMBER</th>
                        <th>DATE OF BIRTH</th>
                        <th>ROLE</th>
                        <th>STATUS</th>
                        <th></th>  
                        <th></th>  
                    </tr>
               
            </thead>
       
            @if($employees->count())
            <tbody  class="justify-content-center" style="cursor: pointer;">
            @foreach ($employees as $employee)  

            <!--  -->
               
                <tr id="target" data-customer= "{{$employee->id}}" style="cursor: pointer;">
                        <td>{{ $employee->id}}</td>
                        <td>{{ $employee->firstname}} {{ $employee->middlename}} {{ $employee->lastname}}</td>
                        <td>{{ $employee->email}}</td>
                        <td>{{ $employee->phone_number}}</td>
                        <td>{{ $employee->date_of_birth}}</td>
                        <td width="12%">
                            @if($employee->roles)
                                @foreach($employee->roles as $employee->role)                
                                        <div class="d-flex justify-content-between">
                                            <div class="role-name">{{$employee->role->name}}</div>
                                        </div>
                                    </form>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $employee->status}}</td>
                        <!-- <td>
                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal" viewBox="0 0 16 16">
                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                            </svg>
                        </td> -->
                        <td>
                            <a href="{{ route('employees.edit', $employee->id) }}">
                                <div>
                                    <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                </div>
                            </a>
                       
                        </td>
                        <td class="deleteTD">
                            <label class="removeInput">
                                    <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    <input class="hideInput deleteUserBtn" name="Delete" value="{{ $employee->id}}">
                            </label>         
                        </td>
                </tr>
                @endforeach      
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
    <h6> To view a specific employee, double click a row with the employee's information</h6>

        @else
        <!-- <div >
            <h1 >NO EMPLOYEEEEES</h1> 
            <a href="{{ route('register') }}" class="text-sm">ADD EMPLPOYEE</a>
        </div> -->
        @endif
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
                    columnDefs: [{ targets: [7,8], orderable: false }],
                    "language": {
                        "emptyTable": "No Employees"
                    }
                })
 
                $("[data-toggle=popover]").popover({
                    html: true,
                    content: function() {
                        return $('#popover-content').html();
                        }
                })
            });
        </script>
 
@endsection



@section('scripts')

        <script>
            $(document).ready(function(){
                $('.deleteUserBtn').click(function(e){
                    e.preventDefault();

                    var customer_id = $(this).val();
                    $('#employee_id').val(customer_id);

                    $('#deleteModal').modal('show');
                });

            });
        </script>

        <script>

            $( "tr" ).dblclick(function() {
                var val = $(this).data('customer');
                window.location.href='/employees/'+val;
             
            });
        </script>


@endsection
 

