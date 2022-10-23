@extends('layout.app')


@section('gymMembersActive-css')

    <style>
        .gymMembersActive{
            background: white;
            border-radius:8px;
        }
    </style>

@endsection

@section('enroll-css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"> 
<link rel="stylesheet" href="{{ asset('/css/enroll.css') }}"/>


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
            <h1 class="head-title"> Enroll Class </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/members/{{$customer->id}}" class="go-back-bg ">
                    <div class="go-back">Go Back</div>
                </a>
        </div>

    </div>
    <div class="show-container w-75">
        <div class="col">
            <div class="header d-flex">
                <span class="name px-3">Name</span>
            </div>
            <div class="px-3">
                <div class="pb-3">
                    <div class="col">
                        <h1 class="customer-name">{{$customer->firstname}} {{$customer->middlename[0]}}. {{$customer->lastname}}</h1>
                    </div>
                    <div class="col">
                        <h2 class="membership-type">Membership Type: {{$membership->name}}</h2>
                    </div>

                </div>
                <div class="table-div">
                    <div class="col">
                            <h2 class="class-head">Enrolled Classes</h2>
                    </div>
                    <table id="first-table" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>CLASS ID</th> -->
                                <th>CLASS NAME</th>
                                <th>STATUS</th>
                                <th>ENROLLEES</th>
                                <!-- <th>DESCRIPTION</th> -->
                                <!-- <th>PRICE</th> -->
                                <th>SCHEDULE</th>
                                <!-- <th>EMPLOYEE ID</th> -->
                                <th>UNENROLL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($enrolled) >= 1)
                        @foreach($enrolled as $class)
                            <tr>
                                <!-- <td>{{$class->class_id}}</td> -->
                                <td>{{$class->name}}</td>
                                <td>{{$class->status}}</td>
                       
                       
                                <td>{{$class->cur_number}} / {{$class->max_enrollees}} </td>
                                <!-- <td>{{$class->description}}</td> -->
                   
                       
                                <!-- <td>{{$class->price}} </td> -->
                                <td>{{$class->schedule}} {{$class->time}} </td>

                                <td>
                                    <label class="removeInput">
                                        <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    <!--    <input class="hideInput" type="submit" value="Unenroll"> -->
                                        <input class="hideInput unenrollUserBtn" type="button" name="delete" value="{{$class->cc_id}}">
                                    </label>
                                    <div class="modal fade" id="unenrollModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                                {!! Form::open(['action' => ['CustEnClassController@destroy', $class->cc_id],'method'=>'POST','class' => '']) !!}
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Unenroll User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="customer_unenroll_id" id="class_id">
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
                                    
                                </td>
                                
                            </tr>
                            

                           
                        @endforeach
                        @else
                        @endif
                        </tbody>
                        
                    </table>
                    <div class="table-div">
                        <div class="col">
                            <h2 class="class-head">Classes</h2>
                        </div>
                        <table id="second-table" class="table" style="width:100%">
                        <thead>
                                <tr>
                                    <!-- <th>CLASS ID</th> -->
                                    <th>CLASS NAME</th>
                                    <th>STATUS</th>
                                    <th>ENROLEES</th>
                                    <!-- <th>DESCRIPTION</th> -->
                                    <!-- <th>PRICE</th> -->
                                    <th>SCHEDULE</th>
                                    <!-- <th>EMPLOYEE ID</th> -->
                                    <th>ENROLL?</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($classes) >= 1)
                            @foreach($classes as $class)

                                <tr>
                                    <!-- <td>{{$class->class_id}}</td> -->
                                    <td>{{$class->name}}</td>
                                    <td>{{$class->status}}</td>
                        
                        
                                    <td> {{$class->cur_number}} / {{$class->max_enrollees}}</td>
                                    <!-- <td>{{$class->description}}</td> -->
                    
                        
                                    <!-- <td>{{$class->price}} </td> -->
                                    <td>{{$class->schedule}} {{$class->time}} </td>
                                    <!-- <td>{{$class->employee_id}} </td> -->
                                    <td class="deleteTD">
                                    {!! Form::open(['action' => ['CustEnClassController@store',$customer->id],'method'=>'POST','class' => '']) !!}

                                        <!-- {{Form::submit('Enroll?', ['class'=> ''])}} -->

                                        <label class="removeInput">
                                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                            </svg>
                                            <input class="hideInput" type="submit" name="customer" value="Enroll?">
                                            <input type="hidden" name="class" value="{{$class->id}}">
                                            <input type="hidden" name="customer" value="{{$customer->id}}">

                                        </label>
                                    {!! Form::close() !!}
                                    </td>
                                </tr>
                                
                            @endforeach
                            @else
                            @endif
                            </tbody>
                        </table>
                    </div>
            </div>
    </div>
</div>

@endsection

@section('enroll-js')
        <!-- javascript needed for the tables -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>


        <!-- <script type="text/javascript" src="{{ URL::asset('/js/index.js') }}"></script> -->
        
        <!-- <script>
            $(document).ready(function () {

                $('table.display').DataTable({
                                        "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
                    "paging": false,//Dont want paging                
                    "bPaginate": false,//Dont want paging  
                    searching: false,
                });
            });
        </script> -->

        <script>
                $('#first-table').DataTable({
                    "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
                    "paging": false,//Dont want paging                
                    "bPaginate": false,//Dont want paging  
                    searching: false,
                    "ordering": false,
                    // columnDefs: [{ targets: [0,1,2,3,4,5,6,7,8,9], orderable: false }],
                    "language": {
                        "emptyTable": "No Classes Enrolled"
                    }
                });
                $('#second-table').DataTable({
                    "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
                    "paging": false,//Dont want paging                
                    "bPaginate": false,//Dont want paging  
                    searching: false,
                    columnDefs: [{ targets: [4], orderable: false }],
                    "language": {
                        "emptyTable": "No Classes"
                    }
                })   

        </script>
@endsection

@section('scripts')

        <script>
            $(document).ready(function(){
                $('.unenrollUserBtn').click(function(e){
                    e.preventDefault();

                    var class_id = $(this).val();
                    $('#class_id').val(class_id);
                  
                    $('#unenrollModal').modal('show');
                });

            });

        </script>

@endsection