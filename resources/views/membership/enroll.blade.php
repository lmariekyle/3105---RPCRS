@extends('layout.app')


@section('membershipActive-css')

    <style>
        .membershipActive{
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
            <h1 class="head-title"> Enroll Gym Member</h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/membership/{{$membership->id}}" class="go-back-bg ">
                    <div class="go-back">Go Back</div>
                </a>
        </div>

    </div>
    <div class="show-container w-75">
        <div class="col">
            <div class="header d-flex">
                <span class="name px-3">Name</span>
            </div>
            <br>
            <div class="px-3">
                <div class="pb-3">
                    <div class="col">
                        <h1 class="customer-name">{{$membership->name}}</h1>
                    </div>
                    <div class="col">
                        <h2 class="membership-type">Members: {{$membership->cur_number}}</h2>
                        
                    </div>
                    <div class="col">
                        <h2 class="membership-type">Membership Price: {{$membership->price}}</h2>
                    </div>
                    <div class="col">
                        <h2 class="membership-type">Membership Duration: ({{$membership->duration}})</h2>
                    </div>

                </div>
                <div class="table-div">
                    <div class="col">
                            <h2 class="class-head">Enrolled Members</h2>
                    </div>
                    <table id="first-table" class="table" style="width:100%">
                        <thead>
                            <tr id="target" data-customer= "0">
                                <th>ID</th>
                                <th>NAME</th>
                                <th>STATUS</th>
                                <th>END OF MEMBERSHIP</th>
                                <th></th>  
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($enrolled) >= 1)
                        @foreach($enrolled as $customer)
                            <tr id="target" data-class= "{{$customer->id}}">
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->firstname}} {{$customer->lastname}}</td>
                            @if($customer->status=="ACTIVE")
                                <td style="color:green">{{$customer->status}}</td>
                            @else
                                <td style="color:red">{{$customer->status}}</td>
                            @endif
                            <td>{{$customer->membership_end_date}}</td>
                            <td class="deleteTD tdIcon">
                                <label class="removeInput">
                                <span id="deletePopover" data-toggle="popover-hover" data-container="body" title="Unenroll" data-content="">
                                    <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </span>
                                <!--    <input class="hideInput" type="submit" value="Unenroll"> -->
                                    <input class="hideInput unenrollUserBtn" type="button" name="delete" value="{{$customer->cc_id}}">
                                </label>

                            
                            </td>
                            
                            {{-- Delete Modal --}}
                            <div class="modal fade" id="unenrollModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                        {!! Form::open(['action' => ['CustEnMembershipController@destroy', $customer->cc_id],'method'=>'POST','class' => '']) !!}
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Unenroll Member</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="customer_unenroll_id" id="customer_id">
                                            <h5>Unenroll this member?<br> This member will be unenrolled from this class</h5>
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
                            

                           
                        @endforeach
                        @else
                        @endif
                        </tbody>
                        
                    </table>
                    <div class="table-div">
                        <div class="col">
                            <h2 class="class-head">Members</h2>
                        </div>
                        <table id="second-table" class="table" style="width:100%">
                        <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>CLASS</th>
                                    <th>STATUS</th>
                                    <th></th>  
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($customers) >= 1)
                            @foreach($customers as $customer)
                                            
                                <tr>
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->firstname}} {{$customer->lastname}}</td>
                                    <td>{{$customer->name}}</td>
                                    @if($customer->status=="ACTIVE")
                                        <td style="color:green">{{$customer->status}}</td>
                                    @else
                                        <td style="color:red">{{$customer->status}}</td>
                                    @endif
                                    <td class="deleteTD">

                                    {!! Form::open(['action' => ['CustEnMembershipController@store',$membership->id],'method'=>'POST','class' => '']) !!}

                                        <!-- {{Form::submit('Enroll?', ['class'=> ''])}} -->

                                        <label class="removeInput">
                                        <span id="assignPopover" data-toggle="popover-hover" data-container="body" title="Enroll" data-content="">
                                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                            </svg>
                                        </span>
                                            <input class="hideInput" type="submit" name="customer" value="Enroll?">
                                            <input type="hidden" name="membership" value="{{$membership->id}}">
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


                            {{-- Info Modal dont mind for now --}}
                            {{-- 
                            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                        
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">This User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                            <div class="modal-body">
                                                <p id="demo"> </p>
                                            
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                        
                                </div>
                                </div>
                            </div>
                            --}}

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
                    columnDefs: [{ targets: [3,4], orderable: false }],
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
                $('.unenrollUserBtn').click(function(e){
                    e.preventDefault();

                    var customer_id = $(this).val();
                    $('#customer_id').val(customer_id);
                  
                    $('#unenrollModal').modal('show');
                });

            });

        </script>
        
        <script>
        /*    $(document).ready(function(){
                $( "tr" ).dblclick(function(e){
                    e.preventDefault();

                    
                    var val = $(this).data('class');
                  
                    if(val!=0){
                        var customer = @json($customers);

                        
                        var cust
                        customer.forEach(element => {
                            
                        });

                        function myFunction(val, customer) {
                            if(val==customer["id"]){
                                return customer;
                            }
                        }
                        
                        document.getElementById("demo").innerHTML = cust.toString();

                        $('#viewModal').modal('show');
                    }        
                });

            });
*/
        </script>

@endsection