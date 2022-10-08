<x-admin-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <div>
                        <h1>Permissions</h1>
                    </div>
                    <div class="permission-create-btn-container">
                        <a href="{{route('admin.permissions.create')}}">Create Permission</a>
                    </div>
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
                @foreach($permissions as $permission)
                 <tr>
                    <td>{{$permission->name}}</td>
                    <td>
                        <div class="action-container">
                            <a href="{{route('admin.permissions.edit', $permission->id) }}">Edit</a>
                            <form method="POST" action="{{route('admin.permissions.destroy', $permission->id)}}" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </div> 
                    </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
    </div>

</x-admin-layout>
