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

      <h1 class="GIM-membersCreate-header">Add Employee</h1>

      {!! Form::open(['action' => 'EmployeeController@store','method' => 'POST']) !!}

      <div class="GIM-membersCreate-container">

        <div class="GIM-membersCreate-container-input">

          <div class="GIM-membersCreate-formAllignment">
          <div class="GIM-employeesCreate-dropListSpace">
            {{Form::label('status','Status')}}
            {{Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], 'Active');}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="GIM-employeesCreate-dropListSpace">
            {{Form::label('role','Role')}}
            {{Form::select('role', ['0' => '0', '1' => '1', '2' => '2']);}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('firstname','First Name')}}
            <br>
            {{Form::text('firstname','')}}
          </div>
          <div class="GIM-membersCreate-rightSide">
            {{Form::label('middlename','Middle Name')}}
            <br>
            {{Form::text('middlename','')}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('lastname','Last Name')}}
            <br>
            {{Form::text('lastname','')}}
          </div>
          <div class="GIM-membersCreate-rightSide">
            {{Form::label('email','Email')}}
            <br>
            {{Form::text('email','')}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('phone_number','Phone Number')}}
            <br>
            {{Form::text('phone_number','')}}
          </div>
          <div class="GIM-membersCreate-inputDate">
            {{Form::label('date_of_birth','Birth Date')}}
            <br>
            {{Form::date('date_of_birth',\Carbon\Carbon::now())}}
          </div>
          </div>

          <div class="GIM-membersCreate-formAllignment">
          <div class="form-group">
            {{Form::label('password','Password')}}
            <br>
            {{Form::text('password','')}}
          </div>
          </div>

          <div class="GIM-membersCreate-container-button">
          {{Form::submit('Add Employee')}}
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