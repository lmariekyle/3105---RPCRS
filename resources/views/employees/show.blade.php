<x-admin-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <h1>Roles</h1>
                    </div>
                    <div class="role-create-btn-container">
                        <a href="{{route('employees.index')}}">View Employees</a>
                    </div>
            </div>
        </div>
    </div>
        <div> 
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
            @foreach ($employee as $employee)            
            
                      <tr>
                        <td>{{ $employee->id}}</td>
                        <td>{{ $employee->firstname}} {{ $employee->middlename}} {{ $employee->lastname}}</td>
                        <td>{{ $employee->date_of_birth}}</td>
                        <td>{{ $employee->phone_number}}</td>
                        <td>{{ $employee->email}}</td>
                        <td>{{ $employee->type}}</td>
                        <td>{{ $employee->status}}</td>
                        <td>
            @endforeach
        </tbody>
</table>           
        </div>
</x-admin-layout>
