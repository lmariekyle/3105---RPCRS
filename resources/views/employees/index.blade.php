@extends('layout.app')


@section('content')
@if($employees->count())
<h1 >VIEEEEW EMPLOYEEEES</h1> 
    <a href="{{ route('employees.create') }}" class="text-sm">ADD EMPLPOYEE</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            <thead> 
            <tbody>
            @foreach ($employees as $employee)            
            
                      <tr>
                        <td>{{ $employee->id}}</td>
                        <td>{{ $employee->firstname}} {{ $employee->middlename}} {{ $employee->lastname}}</td>
                        <td>{{ $employee->date_of_birth}}</td>
                        <td>{{ $employee->phone_number}}</td>
                        <td>{{ $employee->email}}</td>
                        <td>{{ $employee->type}}</td>
                        <td>{{ $employee->status}}</td>
                        <td>
                            <div>
                                <div>
                                    <a href="{{ route('employees.edit', $employee->id) }}">
                                    <button type="button" class=" p-1">EDIT</button>
                                    </a>
                                </div>
                                 <div>
                                    {!! Form::open(['action' => ['EmployeeController@destroy', $employee->id],'method'=>'POST']) !!}
            
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',)}}
                                        
                                    {!! Form::close() !!}
                                 
                                </div>
                                <div>
                                    <a href="{{ route('employees.viewEmployee', $employee->id) }}">
                                    <button type="button" class=" p-1">ROLE</button>
                                    </a>
                                </div>
                            </div>  
                            
                        </td>
                      </tr>                         
            @endforeach
            </tbody>
         </table>
        @else
        <div >
            <h1 >NO EMPLOYEEEEES</h1> 
            <a href="{{ route('employees.create') }}" class="text-sm">ADD EMPLPOYEE</a>
        </div>
        @endif
@endsection