@extends('layout.app')

@section('gymMembersActive-css')

    <style>
        .gymMembersActive{
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
 
    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="view-gym-members"> View Gym Members </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
            <a href="/members/create" class="add-member-bg ">
                <div class="add-member">Add Member</div>
            </a>
        </div>
    </div>
   
    <div class="cont-table">
        <table id="GIMTable" class="table-container table table-hover ">
       
            <thead>
               
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>PHONE NUMBER</th>
                        <th>ADDRESS</th>
                        <th>DATE OF BIRTH</th>
                        <th>CLASS</th>
                        <th>STATUS</th>
                        <!-- <th></th> -->
                        <th></th>  
                        <th></th> 
                        
                    </tr>
               
            </thead>
       
            @if (count($data) >= 1)  
            <tbody  class="justify-content-center" style="cursor: pointer;">
            @foreach($data as $customer)
            <!--  -->
                
                <tr id="target" data-customer= "{{$customer->customer_id}}" style="cursor: pointer;">
                        <td>{{$customer->customer_id}}</td>
                        <td>{{$customer->firstname}} {{$customer->lastname}}</td>
                        <td>{{$customer->phone_number}}</td>
                        <td>{{$customer->city}} City,{{$customer->province}}</td>
                        <td>{{$customer->date_of_birth}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->status}}</td>
                        <!-- <td>
                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal" viewBox="0 0 16 16">
                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                            </svg>
                        </td> -->
                        <td>
                            <a href="/members/{{$customer->customer_id}}/edit">
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
                                    <input class="hideInput deleteUserBtn" type="" name="delete" value="{{$customer->customer_id}}">
                                </label>
                         
                       
                        </td>
                </tr>
                
                @endforeach      
            </tbody>
       

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                        {!! Form::open(['action' => ['CustomerController@destroy', $customer->customer_id],'method'=>'POST','class' => '']) !!}
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="customer_delete_id" id="customer_id">
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
       
        </div>
       
        <div class="d-flex justify-content-end">
            {{$data->links()}}
        </div>
    @else
        <!-- <p>no customers</p> -->
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
                        "emptyTable": "No Members"
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
                    $('#customer_id').val(customer_id);

                    $('#deleteModal').modal('show');
                });

            });
        </script>

        <script>

            $( "tr" ).dblclick(function() {
                var val = $(this).data('customer');
                window.location.href='/members/'+val;
                
            });
        </script>


@endsection
 

