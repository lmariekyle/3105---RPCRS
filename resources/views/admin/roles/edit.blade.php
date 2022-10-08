<x-admin-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <h1>Roles</h1>
                    </div>
                    <div class="role-create-btn-container">
                        <a href="{{route('admin.roles.index')}}">View Permissions</a>
                    </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.roles.update', $role->id)}}">
            @csrf
            @method('PUT')
    <div class="permissions-table">
            <div class="permissions-form">
                <label for="name" class="role-name">Role Name</label>
                <div class="role-input">
                    <input type="text" id="name" name="name"
                    value="{{$role->name}}">
                </div>
                @error('name') <span>{{$message}}</span> @enderror
            </div>
            <div class="btn-container">
                <button type="submit" class="btn-design">Update Role</button>
            </div>
    </div>
    </form>

</x-admin-layout>
