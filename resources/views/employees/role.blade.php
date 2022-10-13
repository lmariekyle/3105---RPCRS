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

    <div class="permissions-role">
        <h2 class="pr-title">Role Permissions</h2>
        <div>
            @if($employee->roles)
                @foreach($employee->roles as $employee->role)
                <form method="POST" action="{{route('employees.roles.remove', [$employee->id, $employee->role->id ])}}" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">{{$employee->role->name}}</button>
                        </form>
                @endforeach
            @endif
        </div>
        <div>
        <form method="POST" action="{{ route('employees.roles', $employee->id)}}">
            @csrf
         <div class="user-roles-table">
            <div class="role-selection">
                <label for="role" class="role-name">Roles</label>
                <select id="role" name="role" autocomplete="role-name" class="role-input">
                    @foreach($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                    @endforeach
                </select>
                @error('name') <span>{{$message}}</span> @enderror
            </div>
            <div class="btn-container">
                <button type="submit" class="btn-design">Assign Role</button>
            </div>
        </div>
    </form>
        </div>
    </div>

</x-admin-layout>
