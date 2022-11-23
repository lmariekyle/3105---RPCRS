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
            <h1 class="head-title"> Add New Gym Class </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/gymclass" class="go-back-bg ">
                    <div class="go-back">Go Back</div>
                </a>
        </div>

    </div>
    
    <br>

    {!! Form::open(['action' => 'GymClassController@store','method'=>'POST']) !!}
    
    <div class="GIM-membersCreate-container">
        <div class="GIM-membersCreate-container-input">
        
            <div class="GIM-membersCreate-formAllignment">
                <div>
                    {{Form::label('name','Class Name')}}
                    <br>
                    {{Form::text('name','',["placeholder"=>"Class Name"])}}
                    <div class="errCreate">{{$errors->first('name')}}</div>
                </div>
            </div>

            <div class="GIM-membersCreate-formAllignment">
                <div>
                    {{Form::label('price','Class Price')}}
                    <br>
                    {{Form::text('price','',["placeholder"=>"₱00.00"])}}
                    <div class="errCreate">{{$errors->first('price')}} </div>
                </div>
                
                <div>
                    {{Form::label('max_enrollees','Maximum Enrollees')}}
                    <br>
                    {{Form::text('max_enrollees','',["placeholder"=>"20"])}}
                    <div class="errCreate">{{$errors->first('max_enrollees')}}</div>
                </div>

            </div>
            <br>
            
            <div class="GIM-membersCreate-formAllignment">
                <h4>TIME:</h4>
                <div class="GIM-membersCreate-membershipSpace">
                    {{Form::label('apm','Morning or Afternoon?')}}
                    <br>
                    <select name="apm" style="margin-left: 5px;">
                        <option value="AM" > AM </option>
                        <option value="PM" > PM </option>
                    </select> 
                    
                </div>
            </div>
        
            <div class="GIM-membersCreate-formAllignment">
                <div>
                    {{Form::label('start','Starting Time')}}
                    <br>
                    {{Form::text('start','',["placeholder"=>"00:00"])}}
                    <div class="errCreate">{{$errors->first('start')}}</div>
                </div>

                <div class="GIM-membersCreate-rightSide">
                    {{Form::label('end','Ending Time')}}
                    <br>
                    {{Form::text('end','',["placeholder"=>"00:00"])}}
                    <div class="errCreate">{{$errors->first('end')}}</div>
                </div>
            </div>


        <div class="GIM-membersCreate-formAllignment">
            <div>
                {{Form::label('schedule','Schedule')}}
                <br>
                {{Form::text('schedule','',["placeholder"=>"MWF,TTH,Weekdays..."])}}
                <div class="errCreate">{{$errors->first('schedule')}}</div>
            </div>
        </div>
    
        
        <div class="GIM-membersCreate-formAllignment">
            <div>
                {{Form::label('description','Description')}}
                <br>
                {{Form::textarea('description','',["placeholder"=>"MWF,TTH,Weekdays..."])}}
                <div class="errCreate">{{$errors->first('description')}}</div>
            </div>
        </div>

        </div>
        </div>


        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Gym Class</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Add new gym class to the database?</h6>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
              </div>
            </div>
        </div>

        <div class="GIM-membersCreate-container-button">
            <button type="button" class="addUserBtn">Add Gym Class</button>
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