@extends('layout.app')

@section('content')
    
    <a href="/members/{{$customer->id}}"><div class="goBack">Go Back</div></a>
    <br>
    <h1>{{$customer->firstname}} {{$customer->middlename[0]}}. {{$customer->lastname}}</h1>
    <br>
    <h2>{{$membership->name}}</h2>

    <h3>Enrolled Classes</h3>

    @if (count($enrolled) >= 1)

        <table class="list">
        @foreach($enrolled as $class)
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
                    {!! Form::open(['action' => ['CustEnClassController@destroy', $class->cc_id],'method'=>'POST','class' => '']) !!}
        
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

    
    <h3>Classes</h3>

    @if (count($classes) >= 1)

    <table class="list">
    @foreach($classes as $class)
        <tr class="row" onclick="location.href='/members/{{$class->class_id}}';" style="cursor: pointer;">
            <div>
                
            <th>
                
                <div class="cell">
                    <h3>
                        
                        {{$class->id}}
                        
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
                {!! Form::open(['action' => ['CustEnClassController@store',$customer->id],'method'=>'POST','class' => '']) !!}

                    <input type="hidden" name="class" value="{{$class->id}}">
                    <input type="hidden" name="customer" value="{{$customer->id}}">
                    {{Form::submit('Enroll?', ['class'=> ''])}}
                        
                {!! Form::close() !!}
            </th>
            </div>
        
        </tr>
    @endforeach
    </table>
@else
    <p>no classes</p>
@endif

   

@endsection

