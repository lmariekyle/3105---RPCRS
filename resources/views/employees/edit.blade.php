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
            <h1 class="head-title"> Update Employee Information</h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/employees" class="go-back-bg ">
                    <div class="go-back">Go Back</div>
                </a>
        </div>

    </div>
    <br>

      {!! Form::open(['action' => ['EmployeeController@update', $employee->id],'method' => 'POST']) !!}
      <div class="GIM-membersCreate-container">

        <div class="GIM-membersCreate-container-input">

          <div class="GIM-membersCreate-formAllignment">
          <div class="GIM-employeesCreate-dropListSpace">
            {{Form::label('status','Status')}}
            {{Form::select('status', ['Active' => 'ACTIVE', 'Inactive' => 'INACTIVE'], $employee->status);}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('firstname','First Name')}}
            <br>
            {{Form::text('firstname',$employee->firstname)}}
          </div>
          <div class="GIM-membersCreate-rightSide">
            {{Form::label('middlename','Middle Name')}}
            <br>
            {{Form::text('middlename',$employee->middlename)}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('lastname','Last Name')}}
            <br>
            {{Form::text('lastname',$employee->lastname)}}
          </div>
          <div class="GIM-membersCreate-rightSide">
            {{Form::label('email','Email')}}
            <br>
            {{Form::text('email',$employee->email)}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('phone_number','Phone Number')}}
            <br>
            {{Form::text('phone_number',$employee->phone_number)}}
          </div>
          <div class="GIM-membersCreate-inputDate">
            {{Form::label('date_of_birth','Birth Date')}}
            <br>
            {{Form::date('date_of_birth',$employee->date_of_birth)}}
          </div>
          </div>

          <!-- <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('password','Password')}}
            <br>
            {{Form::text('password',$employee->password)}}
          </div>
          </div> -->

          

            {{Form::hidden('_method','PUT')}}
        
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Update Employee #{{$employee->id}} information?</h6>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                  </div>
                </div>
            </div>

        

          <div class="GIM-membersCreate-container-button">
            
            
            <button type="button" class="editUserBtn">Update Employee</button>
            
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
                $('.editUserBtn').click(function(e){
                    e.preventDefault();

                    $('#editModal').modal('show');
                });

            });
        </script>

@endsection