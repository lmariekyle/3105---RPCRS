@extends('layout.app')


@section('gymMembersActive-css')

    <style>
        .gymMembersActive{
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
            <h1 class="head-title"> Add New Member </h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
                <a href="/members" class="go-back-bg ">
                    <div class="go-back">Go Back</div>
                </a>
        </div>

    </div>
    
    <br>

    {!! Form::open(['action' => 'CustomerController@store','method'=>'POST']) !!}
    
    <div class="GIM-membersCreate-container">
        <div class="GIM-membersCreate-container-input">
        <div class="GIM-membersCreate-formAllignment">
        <div>
            {{Form::label('firstname','First Name')}}
            <br>
            {{Form::text('firstname','',["placeholder"=>"First Name"])}}
            <div class="errCreate">{{$errors->first('firstname')}}</div>
        </div>
            
        <div class="GIM-membersCreate-rightSide">
            {{Form::label('middlename','Middle Name')}}
            <br>
            {{Form::text('middlename','',["placeholder"=>"Middle Name"])}}
            <div class="errCreate">{{$errors->first('middlename')}}</div>
        </div>
        </div>

        <div class="GIM-membersCreate-formAllignment">
        <div>
            {{Form::label('lastname','Last Name')}}
            <br>
            {{Form::text('lastname','',["placeholder"=>"Last Name"])}}
            <div class="errCreate">{{$errors->first('lastname')}}</div>
        </div>

        <div class="GIM-membersCreate-inputDate">
            {{Form::label('date_of_birth','Date of Birth')}}
            <br>
            {{Form::date('date_of_birth', \Carbon\Carbon::now());}}
            <div class="errCreate">{{$errors->first('date_of_birth')}} </div>

        </div>
        </div>

        <div class="GIM-membersCreate-formAllignment">
        <div>
            {{Form::label('phone_number','Phone Number')}}
            <br>
            {{Form::text('phone_number','',["placeholder"=>"+63"])}}
            <div class="errCreate">{{$errors->first('phone_number')}}</div>
        </div>
        <div class="GIM-membersCreate-rightSide">
            {{Form::label('email','E-mail')}}
            <br>
            {{Form::email('email','')}}
            <div class="errCreate">{{$errors->first('email')}}</div>
        </div>
        </div>

        <div class="GIM-membersCreate-formAllignment">
        <div class="GIM-membersCreate-membershipSpace">
            {{Form::label('membership','Membership')}} :
            <select name="membership" style="margin-left: 5px;">
                    <option value="NONE"> NONE </option>
                @foreach($memberships as $membership)
                    <option value="{{$membership->id}}" >{{$membership->name}}</option>
                @endforeach
            </select>    
        </div>
        </div>

        <div name="address">
            <div class="GIM-membersCreate-formAllignment">
            <div>
                {{Form::label('house_number','House Number')}}
                <br>
                {{Form::text('house_number','',)}}
            </div>
            <div class="GIM-membersCreate-rightSide">
                {{Form::label('street_name','Street Name')}}
                <br>
                {{Form::text('street_name','',)}}
            </div>
            </div>

            <div class="GIM-membersCreate-formAllignment">
            <div>
                {{Form::label('barangay','Barangay')}}
                <br>
                {{Form::text('barangay','',)}}
            </div>
            <div class="GIM-membersCreate-rightSide">
                {{Form::label('municipality','Municipality')}}
                <br>
                {{Form::text('municipality','',)}}
            </div>
            </div>

            <div class="GIM-membersCreate-formAllignment">
            <div>
                {{Form::label('city','City')}}
                <br>
                {{Form::text('city','',)}}
                <div class="errCreate">{{$errors->first('city')}}</div>
            </div>
            <div class="GIM-membersCreate-rightSide">
                {{Form::label('province','Province')}}
                <br>
                {{Form::text('province','',)}}
                <div class="errCreate">{{$errors->first('province')}}</div>
            </div>
            </div>

            <div class="GIM-membersCreate-formAllignment">
            <div class="GIM-membersCreate-inputZipCode">
                {{Form::label('zip_code','Zip Code')}}
                <br>
                {{Form::text('zip_code','',)}}
            </div>
            </div>
        </div>
        </div>


        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Member</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Add new member to the database?</h6>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
              </div>
            </div>
        </div>

        <div class="GIM-membersCreate-container-button">
            <button type="button" class="addUserBtn">Add Member</button>
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