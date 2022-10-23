@extends('layout.app')

@section('employeesActive-css')

    <style>
        .employeesActive{
            background: white;
            border-radius:8px;
        }
    </style>

@endsection

@section('content')
<div>
 
  <div>
    
    @if(session('error'))
          <div  class = "alert alert-danger">
            {{session('error')}}
          </div>
    @endif

    <div class="GIM-membersCreate">

      <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="head-title"> Add New Employee </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/employees" class="go-back-bg ">
                    <div class="go-back">Go Back</div>
                </a>
        </div>

    </div>
    <br>

      {!! Form::open(['action' => 'EmployeeController@store','method' => 'POST']) !!}

      <div class="GIM-membersCreate-container">

        <div class="GIM-membersCreate-container-input">
          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('firstname','First Name')}}
            <br>
            {{Form::text('firstname','')}}
            <div class="errCreate">{{$errors->first('firstname')}}</div>
          </div>
          <div class="GIM-membersCreate-rightSide">
            {{Form::label('middlename','Middle Name')}}
            <br>
            {{Form::text('middlename','')}}
            <div class="errCreate">{{$errors->first('middlename')}}</div>
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('lastname','Last Name')}}
            <br>
            {{Form::text('lastname','')}}
            <div class="errCreate">{{$errors->first('lastname')}}</div>
          </div>
          <div class="GIM-membersCreate-rightSide">
            {{Form::label('email','Email')}}
            <br>
            {{Form::text('email','')}}
            <div class="errCreate">{{$errors->first('email')}}</div>
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('phone_number','Phone Number')}}
            <br>
            {{Form::text('phone_number','')}}
            <div class="errCreate">{{$errors->first('phone_number')}}</div>
          </div>
          <div class="GIM-membersCreate-inputDate">
            {{Form::label('date_of_birth','Birth Date')}}
            <br>
            {{Form::date('date_of_birth',\Carbon\Carbon::now())}}
            <div class="errCreate">{{$errors->first('date_of_birth')}}</div>
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('password','Password')}}
            <br>
            {{Form::text('password','')}}
            <div class="errCreate">{{$errors->first('password')}}</div>
          </div>
          </div>

          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Employee</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Add new employee to the database?</h6>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
              </div>
            </div>
        </div>

          <div class="GIM-membersCreate-container-button">
              <button type="button" class="addUserBtn">Add Employee</button>
          
          </div>

      {!! Form::close() !!}
        </div>
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