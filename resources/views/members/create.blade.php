@extends('layout.app')

@section('content')
    <h1>Add New Member</h1>
    
    <a href="/members"><div class="goBack">Go Back</div></a>
    {!! Form::open(['action' => 'CustomerController@store','method'=>'POST']) !!}
    
        <div>
            {{Form::label('firstname','First Name')}}
            {{Form::text('firstname','',["placeholder"=>"First Name"])}}
        </div>
            <div class="errCreate">{{$errors->first('firstname')}}</div>
        <div>
            {{Form::label('middlename','Middle Name')}}
            {{Form::text('middlename','',["placeholder"=>"Middle Name"])}}
        </div>
            <div class="errCreate">{{$errors->first('middlename')}}</div>
        <div>
            {{Form::label('lastname','Last Name')}}
            {{Form::text('lastname','',["placeholder"=>"Last Name"])}}
        </div>
            <div class="errCreate">{{$errors->first('lastname')}}</div>
        <div>
            {{Form::label('date_of_birth','Date of Birth')}}
            {{Form::date('date_of_birth', \Carbon\Carbon::now());}}
        </div>
            <div class="errCreate">{{$errors->first('date_of_birth')}}</div>
        <div>
            {{Form::label('phone_number','Phone Number')}}
            {{Form::text('phone_number','',["placeholder"=>"+63"])}}
        </div>
            <div class="errCreate">{{$errors->first('phone_number')}}</div>
        <div>
            {{Form::label('email','E-mail')}}
            {{Form::email('email','')}}
        </div>
            <div class="errCreate">{{$errors->first('email')}}</div>
        <div>
            {{Form::label('membership','Membership')}}
            <select name="membership">
                @foreach($memberships as $membership)
                    <option value="{{$membership->id}}" class="errCreate">{{$membership->name}}</option>
                @endforeach
            </select>
            
            
        </div>
        <div name="address">
            <div>
                {{Form::label('house_number','House Number')}}
                {{Form::text('house_number','',)}}
            </div>
            <div>
                {{Form::label('street_name','Street Name')}}
                {{Form::text('street_name','',)}}
            </div>
            <div>
                {{Form::label('barangay','Barangay')}}
                {{Form::text('barangay','',)}}
            </div>
            <div>
                {{Form::label('municipality','Municipality')}}
                {{Form::text('municipality','',)}}
            </div>
            <div>
                {{Form::label('city','City')}}
                {{Form::text('city','',)}}
            </div>
                <div class="errCreate">{{$errors->first('city')}}</div>
            <div>
                {{Form::label('province','Province')}}
                {{Form::text('province','',)}}
            </div>
                <div class="errCreate">{{$errors->first('province')}}</div>
            <div>
                {{Form::label('zip_code','Zip Code')}}
                {{Form::text('zip_code','',)}}
            </div>
        </div>

        {{Form::submit('Submit')}}
    {!! Form::close() !!}

@endsection