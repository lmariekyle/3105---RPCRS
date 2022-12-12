@extends('layout.app')


@section('classesActive-css')

    <style>
        .classesActive{
            background: white;
            border-radius:8px;
        }
    </style>

@endsection

@section('content')


@if(session('error'))
    <div  class = "alert alert-danger">
        {{session('error')}}
    </div>
@endif

<div class="GIM-membersCreate">
    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="head-title"> Add New Gym Membership </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/membership" class="go-back-bg ">
                    <div class="go-back">Go Back</div>
                </a>
        </div>

    </div>
    
    <br>

    {!! Form::open(['action' => 'MembershipController@store','method'=>'POST']) !!}
    
    <div class="GIM-membersCreate-container">
        <div class="GIM-membersCreate-container-input">
        
            <div class="GIM-membersCreate-formAllignment">
                <div>
                    {{Form::label('name','Membership Name')}}
                    <br>
                    {{Form::text('name','',["placeholder"=>"Membership Name"])}}
                    <div class="errCreate">{{$errors->first('name')}}</div>
                </div>
            </div>

            <div class="GIM-membersCreate-formAllignment GIM-gymDigitInput1">
                <div>
                    {{Form::label('price','Membership Price')}}
                    <br>
                    {{Form::text('price','',["placeholder"=>"₱00.00"])}}
                    <div class="errCreate">{{$errors->first('price')}} </div>
                </div>
                

            </div>
            <br>
            
            <div class="GIM-membersCreate-formAllignment">
                <div>
                <h4>Duration:</h4>
                    {{Form::label('months','How long is the membership? (limited to 1 year)')}}
                        <select name="months" style="margin-left: 5px;">
                            <option value="1 MONTH" > 1 MONTH </option>
                            <option value="2 MONTHS" > 2 MONTHS </option>
                            <option value="3 MONTHS" > 3 MONTHS </option>
                            <option value="4 MONTHS" > 4 MONTHS </option>
                            <option value="5 MONTHS" > 5 MONTHS </option>
                            <option value="6 MONTHS" > 6 MONTHS </option>
                            <option value="7 MONTHS" > 7 MONTHS </option>
                            <option value="8 MONTHS" > 8 MONTHS </option>
                            <option value="9 MONTHS" > 9 MONTHS </option>
                            <option value="10 MONTHS" > 10 MONTHS </option>
                            <option value="11 MONTHS" > 11 MONTHS </option>
                            <option value="12 MONTHS" > 12 MONTHS </option>
                        </select> 
                </div>
                    
            </div>

        
        
        <div class="GIM-membersCreate-formAllignment GIM-gymTextArea">
            <div>
                {{Form::label('description','Description')}}
                <br>
                <div class="GIM-membershipResizeTextArea">
                {{Form::textarea('description','',["placeholder"=>"This membership is about..."])}}
                </div>
                <div class="errCreate">{{$errors->first('description')}}</div>
            </div>
        </div>

        </div>
        </div>


        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Gym Membership</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Add new gym membership to the database?</h6>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
              </div>
            </div>
        </div>

        <div class="GIM-membersCreate-container-button GIM-membershipRemakeButton">
            <button type="button" class="addUserBtn">Add Gym Membership</button>
            {!! Form::close() !!}
        </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')

        <script>
            $(document).ready(function(){
                $('.addUserBtn').click(function(e){
                    e.preventDefault();

                    $('#addModal').modal('show');
                });

            });
        </script>

    
@endsection