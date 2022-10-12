@extends('layout.app')

@section('content')

    <a href="/members"><div class="goBack">Go Back</div></a>
    <br>
    <h1>{{$customer->firstname}} {{$customer->middlename[0]}}. {{$customer->lastname}}</h1>
    <br>
    <h2>{{$membership->name}}</h2>
    <h2>{{$customer->id}}</h2>
    <h2>{{$customer->status}}</h2>
    <h2>{{$customer->date_of_birth}}</h2>
    <br>
    <h2>{{$customer->phone_number}}</h2>
    <h2>{{$customer->email}}</h2>
    <br>
    <h3>Membership Start {{$customer->membership_start_date}}</h3>
    <h3>Membership End {{$customer->membership_end_date}}</h3>
    
    <a href="/members/{{$customer->id}}/edit"><div>Edit</div></a>
    
    {!! Form::open(['action' => ['CustomerController@destroy', $customer->id],'method'=>'POST','class' => '']) !!}
        
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete', ['class'=> ''])}}
    
        
    {!! Form::close() !!}
    
    <a href="/members/{{$customer->id}}/class/create"><div>Enroll?</div></a>
    
    @if (count($classes) >= 1)


        <table class="list">
        @foreach($classes as $class)
            <tr class="row" onclick="location.href='';" style="cursor: pointer;">
                <div>
                    
                <th>
                    
                    <div class="cell">
                        <h3>
                            
                            {{$class->class_id}}
                            
                        </h3>
                    </div>
                    
                </th>
                
                <th>
                    <div class="cell">
                        <h3>{{$class->name}} </h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$class->status}}</h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$class->max_enrollees}} {{$class->cur_number}}</h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$class->description}} </h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$class->price}} </h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$class->schedule}} {{$class->time}} </h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$class->employee_id}} </h3>
                    </div>
                </th>
                
                <th>
                    {!! Form::open(['action' => ['CustomerClassController@destroy', $class->cc_id],'method'=>'POST','class' => '']) !!}
        
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Unenroll', ['class'=> ''])}}
                        
                    {!! Form::close() !!}
                    
                </th>
                </div>
            
            </tr>
        @endforeach
        </table>
    @else
        <p>no classes enrolled</p>
    @endif

   

@endsection

