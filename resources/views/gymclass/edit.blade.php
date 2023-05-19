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
            <h1 class="head-title"> Edit Gym Class </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/gymclass" class="go-back-bg ">
                    <div class="go-back">Go Back</div>
                </a>
        </div>

    </div>
    
    <br>

    {!! Form::open(['action' => ['GymClassController@update',$gymclass->id],'method'=>'POST']) !!}
    
    <div class="GIM-membersCreate-container">
        <div class="GIM-membersEdit-statusRadio">
            Class Status: 
            @if($gymclass->status=="ACTIVE")
                <h6 style="color:green">{{$gymclass->status}}</h6>
            @else
                <h6 style="color:red">{{$gymclass->status}}</h6>
            @endif
            
            
            <br>
            {{Form::label('status','Status',['class' => 'class-name-for-labels'])}} :
            <select name="status" style="margin-left: 5px;">
                <option value="{{$gymclass->status}}">{{$gymclass->status}}</option>
                <option disabled></option>
                <option value="ACTIVE" >ACTIVE</option>
                <option value="INACTIVE" >INACTIVE</option>
            </select> 
        </div>

        <div class="GIM-membersCreate-container-input">
        
            <div class="GIM-membersCreate-formAllignment">
                <div>
                    {{Form::label('name','Class Name')}}
                    <br>
                    {{Form::text('name',$gymclass->name,["placeholder"=>"Class Name"])}}
                    <div class="errCreate">{{$errors->first('name')}}</div>
                </div>
            </div>

            <div class="GIM-membersCreate-formAllignment GIM-gymDigitInput1">
                <div>
                    {{Form::label('price','Class Price')}}
                    <br>
                    {{Form::text('price',$gymclass->price,["placeholder"=>"₱00.00"])}}
                    <div class="errCreate">{{$errors->first('price')}} </div>
                </div>
                
                <div class="GIM-membersCreate-rightSide GIM-gymDigitInput2" style="margin-left:10%;">
                    {{Form::label('max_enrollees','Maximum Enrollees')}}
                    <br>
                    {{Form::text('max_enrollees',$gymclass->max_enrollees,["placeholder"=>"20"])}}
                    <div class="errCreate">{{$errors->first('max_enrollees')}}</div>
                </div>

            </div>
                <br>
            <div class="GIM-membersCreate-formAllignment">
                <div>
                <h5> TIME:  Currently: {{$gymclass->time}} </h5>   
                    {{Form::label('apm','Morning or Afternoon?')}}
                        <select id="apm" name="apm" style="margin-left: 5px;">
                            <option value={{$time[1]}}> {{$time[1]}} </option>
                            <option disabled></option>
                            <option value="AM" > AM </option>
                            <option value="PM" > PM </option>
                        </select> 
                </div>       
        
                <div class="GIM-membersCreate-rightSide GIM-gymRightSide" style="margin-left:25%; margin-top:0%;">
                    <div class="GIM-membersCreate-formAllignment GIM-gymDigitInput2">
                        <div>
                            {{Form::label('start','Starting Time')}}
                            <br>
                            {{Form::text('start',$time[0],["placeholder"=>"00:00"])}}
                            <div class="errCreate">{{$errors->first('start')}}</div>
                        </div>

                        <div class="GIM-membersCreate-rightSide GIM-gymDigitInput2">
                            {{Form::label('end','Ending Time')}}
                            <br>
                            {{Form::text('end',$time[3],["placeholder"=>"00:00"])}}
                            <div class="errCreate">{{$errors->first('end')}}</div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="GIM-membersCreate-formAllignment">
            <div>
                {{Form::label('schedule','Schedule')}}
                <br>
                {{Form::text('schedule',$gymclass->schedule,["placeholder"=>"MWF,TTH,Weekdays..."])}}
                <div class="errCreate">{{$errors->first('schedule')}}</div>
            </div>
        </div>
    
        
        <div class="GIM-membersCreate-formAllignment GIM-gymTextArea">
            <div>
                {{Form::label('description','Description')}}
                <br>
                {{Form::textarea('description',$gymclass->description,["placeholder"=>"MWF,TTH,Weekdays..."])}}
                <div class="errCreate">{{$errors->first('description')}}</div>
            </div>
        </div>

        </div>
        </div>

        {{Form::hidden('_method','PUT')}}

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Member Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Update Gym Member #{{$gymclass->id}} information?</h6>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
              </div>
            </div>
        </div>


        <div class="GIM-membersCreate-container-button">
            <button type="button" class="editUserBtn">Update</button>
            {!! Form::close() !!}
        </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')

        <script>
            $(document).ready(function(){
                $('.editUserBtn').click(function(e){
                    e.preventDefault();

                    $('#editModal').modal('show');
                });

            });
        </script>

    
@endsection