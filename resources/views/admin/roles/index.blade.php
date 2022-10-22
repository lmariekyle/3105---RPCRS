<x-admin-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <h1>Roles</h1>
                    </div>
                    <div class="role-create-btn-container">
                        <a href="{{route('admin.roles.create')}}">Create Role</a>
                    </div>
            </div>
        </div>
    </div>

    <div class="roles-table">
    <table>
             
             <!-- thead tag starts from here -->
             <thead>
                 <tr>
                 <th>Name</th>
                 <th>Action</th>
                 </tr>
             </thead>
             <!-- thead tag ends here -->
              
             <tbody>
                @foreach($roles as $role)
                 <tr>
                    <td>{{$role->name}}</td>
                    <td>
                    <div class="action-container">
                            <a href="{{route('admin.roles.edit', $role->id) }}">Edit</a>
                        <!-- <a href="">Delete</a> -->
                        <form method="POST" action="{{route('admin.roles.destroy', $role->id)}}" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                        </form>
                    </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
    </div>

</x-admin-layout>
<style>
        .rolesActive{
            background: white;
            border-radius:8px;
        }
</style>