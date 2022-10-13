@extends('layout.app')

@section('content')

    <h1> MEMBERS </h1>
    <a href="/members/create"><div>Add Member</div></a>




    @if (count($data) >= 1)
        <table class="list">
        @foreach($data as $customer)
            <tr class="row" onclick="location.href='/members/{{$customer->customer_id}}';" style="cursor: pointer;">
                <div>
                    
                
                <th>
                    
                    <div class="cell">
                        <h3>
                            
                            {{$customer->customer_id}}
                            
                        </h3>
                    </div>
                    
                </th>
                
                <th>
                    <div class="cell">
                        <h3>{{$customer->firstname}} {{$customer->lastname}}</h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$customer->phone_number}}</h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$customer->city}} City,{{$customer->province}}</h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$customer->date_of_birth}}</h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$customer->name}}</h3>
                    </div>
                </th>
                <th>
                    <div class="cell">
                        <h3>{{$customer->status}}</h3>
                    </div>
                </th>
                
                <th>
                    <a href="/members/{{$customer->customer_id}}/edit">
                        <div>Edit</div>
                    </a>
                    
                </th>
                <th>
                    {!! Form::open(['action' => ['CustomerController@destroy', $customer->customer_id],'method'=>'POST','class' => '']) !!}
        
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete', ['class'=> ''])}}
                        
                    {!! Form::close() !!}
                    
                </th>
                </div>
            
            </tr>
        @endforeach
        </table>
        {{$data->links()}}
    @else
        <p>no customers</p>
    @endif

@endsection