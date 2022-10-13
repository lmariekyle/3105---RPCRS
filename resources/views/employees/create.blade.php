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

    {!! Form::open(['action' => 'EmployeeController@store','method' => 'POST']) !!}
      <div class="form-group">
        {{Form::label('status','Status')}}
        {{Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], 'Active');}}
      </div>
      <div class="form-group">
        {{Form::label('type','Type')}}
        {{Form::select('type', ['Staff' => 'Staff', 'Employee' => 'Employee', 'Instructor' => 'Instructor']);}}
      </div>
      <div class="form-group">
        {{Form::label('firstname','First Name')}}
        {{Form::text('firstname','')}}
      </div>
      <div class="form-group">
        {{Form::label('middlename','Middle Name')}}
        {{Form::text('middlename','')}}
      </div>
      <div class="form-group">
        {{Form::label('lastname','Last Name')}}
        {{Form::text('lastname','')}}
      </div>
      <div class="form-group">
        {{Form::label('email','Email')}}
        {{Form::text('email','')}}
      </div>
      <div class="form-group">
        {{Form::label('phone_number','Phone Number')}}
        {{Form::text('phone_number','')}}
      </div>
      <div class="form-group">
        {{Form::label('date_of_birth','Birth Date')}}
        {{Form::date('date_of_birth',\Carbon\Carbon::now())}}
      </div>
      <div class="form-group">
        {{Form::label('password','Password')}}
        {{Form::text('password','')}}
      </div>
      {{Form::submit('Submit')}}

    {!! Form::close() !!}
   
    <button type="button"><a href="/employees">Back</a></button>
     
    
  </div>
</div>

@endsection