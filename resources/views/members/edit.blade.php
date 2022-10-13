@extends('layout.app')

@section('content')

    <h1>Edit Membe Informationr</h1>
    
    <a href="/members"><div class="goBack">Go Back</div></a>
    {!! Form::open(['action' => ['CustomerController@update', $customer->id],'method'=>'POST']) !!}
        <div>
            Current Membership Plan:{{$customer->status}}
            <br>
            {{Form::label('status','Status',['class' => 'class-name-for-labels'])}} :
            ACTIVE{{Form::radio('status','ACTIVE',)}}
            INACTIVE{{Form::radio('status','INACTIVE',)}}
        </div>
        <div>
            {{Form::label('firstname','First Name',['class' => 'class-name-for-labels'])}}
            {{Form::text('firstname',$customer->firstname,)}}
        </div>
        <div>
            {{Form::label('middlename','Middle Name',['class' => 'class-name-for-labels'])}}
            {{Form::text('middlename',$customer->middlename,)}}
        </div>
        <div>
            {{Form::label('lastname','Last Name',['class' => 'class-name-for-labels'])}}
            {{Form::text('lastname',$customer->lastname,)}}
        </div>
        <div>
            {{Form::label('date_of_birth','Date of Birth',['class' => 'class-name-for-labels'])}}
            {{Form::date('date_of_birth', $customer->date_of_birth)}}
        </div>
        <div>
            {{Form::label('phone_number','Phone Number',['class' => 'class-name-for-labels'])}}
            {{Form::text('phone_number',$customer->phone_number,)}}
        </div>
        <div>
            {{Form::label('email','E-mail',['class' => 'class-name-for-labels'])}}
            {{Form::email('email',$customer->email)}}
        </div>
        <div>
            {{Form::label('membership','Membership',['class' => 'class-name-for-labels'])}}
            <h4> Current Membership Plan: {{$currplan->name}} </h4>
            <select name="membership">
                @foreach($memberships as $membership)
                    <option value="{{$membership->id}}">{{$membership->name}}</option>
                @endforeach
            </select>
            
        </div>
        <div name="address">
            <div>
                {{Form::label('house_number','House Number',['class' => 'class-name-for-labels'])}}
                {{Form::text('house_number',$customer->house_number,)}}
            </div>
            <div>
                {{Form::label('street_name','Street Name',['class' => 'class-name-for-labels'])}}
                {{Form::text('street_name',$customer->street_name,)}}
            </div>
            <div>
                {{Form::label('barangay','Barangay',['class' => 'class-name-for-labels'])}}
                {{Form::text('barangay',$customer->barangay,)}}
            </div>
            <div>
                {{Form::label('municipality','Municipality',['class' => 'class-name-for-labels'])}}
                {{Form::text('municipality',$customer->municipality,)}}
            </div>
            <div>
                {{Form::label('city','City',['class' => 'class-name-for-labels'])}}
                {{Form::text('city',$customer->city,)}}
            </div>
            <div>
                {{Form::label('province','Province',['class' => 'class-name-for-labels'])}}
                {{Form::text('province',$customer->province,)}}
            </div>
            <div>
                {{Form::label('zip_code','Zip Code',['class' => 'class-name-for-labels'])}}
                {{Form::text('zip_code',$customer->zip_code,)}}
            </div>
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit')}}
    {!! Form::close() !!}

@endsection