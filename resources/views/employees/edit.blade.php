@extends('layout.app')

@section('content')
<div>
 
  <div>
  	@if ($message = Session::get('success'))
        <div>        
                <p>{{ $message }}</p> 
        </div>
    @endif

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
          <div class="alert alert-danger">
           {{$error}}
          </div>
        @endforeach
    @endif

    @if(session('error'))
          <div  class = "alert alert-danger">
            {{session('error')}}
          </div>
    @endif

    <div class="GIM-membersCreate">

      <h1 class="GIM-membersCreate-header">Edit Employee</h1>

      {!! Form::open(['action' => ['EmployeeController@update', $employee->id],'method' => 'POST']) !!}
      <div class="GIM-membersCreate-container">

        <div class="GIM-membersCreate-container-input">

          <div class="GIM-membersCreate-formAllignment">
          <div class="GIM-employeesCreate-dropListSpace">
            {{Form::label('status','Status')}}
            {{Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], $employee->status);}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="GIM-employeesCreate-dropListSpace">
            {{Form::label('role','Role')}}
            {{Form::select('role', ['0' => '0', '1' => '1', '2' => $employee->role]);}}
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

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('password','Password')}}
            <br>
            {{Form::text('password',$employee->password)}}
          </div>
          </div>

          <div class="GIM-membersCreate-container-button">
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Edit Employee')}}
          </div>

      {!! Form::close() !!}
        </div>

      </div>
   
    <div class="GIM-membersCreate-goBackLink">
    <button type="button"><a href="/employees">Back</a></button>
    </div>
     
    </div>

  </div>
</div>

@endsection