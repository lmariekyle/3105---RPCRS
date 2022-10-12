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

    {!! Form::open(['action' => ['EmployeeController@update', $employee->id],'method' => 'POST']) !!}
      <div class="form-group">
        {{Form::label('status','Status')}}
        {{Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], $employee->status);}}
      </div>
      <div class="form-group">
        {{Form::label('type','Type')}}
        {{Form::select('type', ['Staff' => 'Staff', 'Employee' => 'Employee', 'Instructor' => $employee->type]);}}
      </div>
      <div class="form-group">
        {{Form::label('firstname','First Name')}}
        {{Form::text('firstname',$employee->firstname)}}
      </div>
      <div class="form-group">
        {{Form::label('middlename','Middle Name')}}
        {{Form::text('middlename',$employee->middlename)}}
      </div>
      <div class="form-group">
        {{Form::label('lastname','Last Name')}}
        {{Form::text('lastname',$employee->lastname)}}
      </div>
      <div class="form-group">
        {{Form::label('email','Email')}}
        {{Form::text('email',$employee->email)}}
      </div>
      <div class="form-group">
        {{Form::label('phone_number','Phone Number')}}
        {{Form::text('phone_number',$employee->phone_number)}}
      </div>
      <div class="form-group">
        {{Form::label('date_of_birth','Birth Date')}}
        {{Form::date('date_of_birth',$employee->date_of_birth)}}
      </div>
      <div class="form-group">
        {{Form::label('password','Password')}}
        {{Form::text('password',$employee->password)}}
      </div>
      {{Form::hidden('_method','PUT')}}
      {{Form::submit('Submit')}}

    {!! Form::close() !!}
   
    <button type="button"><a href="/employees">Back</a></button>
     
    
  </div>
</div>

@endsection