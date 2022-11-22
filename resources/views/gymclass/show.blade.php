@extends('layout.app')


@section('gymMembersActive-css')

    <style>
        .gymMembersActive{
            background: white;
            border-radius:8px;
        }
    </style>

@endsection

@section('show-css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/css/show.css') }}"/>

<style>
tr, th, td,{
    border:none;
    /* background-color:white; */
    box-shadow:none;
}
table.dataTable thead th {
    border: none;
}
 
table.dataTable tbody td {
    border:none;
}
 
table.dataTable tbody tr {
    border:none;
}
</style>
@endsection

@section('content')
<div class="show-blade-container">
    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="head-title"> Gym Class Profile </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/gymclass" class="go-back-bg ">
                    <div class="go-back">View Gym Classes</div>
                </a>
        </div>

    </div>
    <div class="show-container">
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
                <table id="first-table" class="table " style="width:100%">
                        <thead>
                            <tr>
                                <th>CLASS ID</th>
                                <th>STATUS</th>
                                <th>ENROLEES</th>
                                <th>DESCRIPTION</th>
                                <th>PRICE</th>
                                <th>SCHEDULE</th>
                                <th>INSTRUCTOR</th>
                                <th></th>
                                <th>ACTION</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$gymclass->id}}</td>
                                <td>{{$gymclass->name}}</td>
                                <td>{{$gymclass->status}}</td>
                        
                        
                                <td>{{$gymclass->cur_number}} / {{$gymclass->max_enrollees}}</td>
                                <td>{{$gymclass->price}}</td>
                                <td>({{$gymclass->schedule}}) {{$gymclass->time}}</td>
                                <td>
                                    @if($instructors->count())
                                    @foreach($instructors as $instructor)                                            
                                        <div class="d-flex justify-content-start">
                                            <div>  {{$instructor->employeefirstname}} {{$instructor->employeelastname}}</div>
                                        </div>                                        
                                    @endforeach
                                    @else
                                    VACANT
                                    @endif
                                </td>
                                
                                <td>
                                <a href="/gymclass/{{$gymclass->id}}/edit">
                                    <div>
                                    <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                    </div>
                                </a>
                                </td>
                                @role('admin')
                                <td class="deleteTD">
                                    <label class="removeInput">
                                
                                        <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                        <input class="hideInput deleteUserBtn" type="" name="delete" value="{{$gymclass->id}}">
                                    </label>
                                </td>
                                <td>
                                    <a href="{{ route('staffdetails.show', $gymclass->id) }}">put icon here for add insntructor</a>
                                </td>
                                @endrole
                            </tr>
                            
                        </tbody>
                            
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    {!! Form::open(['action' => ['GymClassController@destroy', $gymclass->id],'method'=>'POST','class' => '']) !!}
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="class_delete_id" id="class_id">
                                        <h5>Delete this user?<br> All information stored on this user will be deleted</h5>
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
 
                <div class="table-div">
                    <div class="my-custom-row d-flex flex-row justify-content-between " >
                        <div class="col">
                            <h2 class="class-head">Enrolled Members</h2>
                        </div>
                        
                        <a href="/gymclass/{{$gymclass->id}}/enmem/create">
                            <button class="enrollBtn btn btn-primary">
                            Enroll?
                            </button>
                        </a>
                
                    </div>
                    
                    <table id="second-table" class="table" style="width:100%">
                        <thead>
                            <tr id="target" data-customer= "0">
                                <th>ID</th>
                                <th>NAME</th>
                                <th>CLASS</th>
                                <th>STATUS</th>
                                <th></th>  
                                <th></th> 
                                
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($customer) >= 0)
                        @foreach($customer as $customer)
                        <!-- onclick="location.href='';" style="cursor: pointer;" -->
                            <tr>
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->firstname}} {{$customer->lastname}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->status}}</td>
                        
                                <td class="deleteTD">
                                    <label class="removeInput">
                                        <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    <!--    <input class="hideInput" type="submit" value="Unenroll"> -->
                                        <input class="hideInput unenrollUserBtn" type="button" name="delete" value="{{$customer->cc_id}}">
                                    </label>

                                
                                </td>
                                <td></td>
                                <div class="modal fade" id="unenrollModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                            {!! Form::open(['action' => ['ClassCustomerController@destroy', $customer->cc_id],'method'=>'POST','class' => '']) !!}
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Unenroll User</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="customer_unenroll_id" id="customer_id">
                                                <h5>Unenroll this user?<br> This user will be unenrolled from this class</h5>
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

                            </tr>
                        </tbody>
                        @endforeach
                        @else
                        @endif
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
                        "emptyTable": "Class does not exist."
                    }
                })
                $('#second-table').DataTable({
                    "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
                    "paging": false,//Dont want paging                
                    "bPaginate": false,//Dont want paging  
                    searching: false,
                    columnDefs: [{ targets: [3,4,6,7,8], orderable: false }],
                    "language": {
                        "emptyTable": "No Enrolled Members"
                    }
                })   
        </script>

@endsection


@section('scripts')

        <script>
            $(document).ready(function(){
                $('.deleteUserBtn').click(function(e){
                    e.preventDefault();

                    var class_id = $(this).val();
                    $('#class_id').val(class_id);

                    $('#deleteModal').modal('show');
                });

            });
            $(document).ready(function(){
                $('.unenrollUserBtn').click(function(e){
                    e.preventDefault();
                    var customer_id = $(this).val();
                    $('#customer_id').val(customer_id);
                  
                    $('#unenrollModal').modal('show');
                });
            });
        </script>

@endsection
 