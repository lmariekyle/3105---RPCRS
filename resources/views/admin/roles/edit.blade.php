<x-admin-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <h1>Roles</h1>
                    </div>
                    <div class="role-create-btn-container">
                        <a href="{{route('admin.roles.index')}}">View Roles</a>
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

    <div class="permissions-role">
        <h2 class="pr-title">Role Permissions</h2>
        <div>
            @if($role->permissions)
                @foreach($role->permissions as $role->permission)
                <form method="POST" action="{{route('admin.roles.permissions.revoke', [$role->id, $role->permission->id ])}}" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">{{$role->permission->name}}</button>
                        </form>
                @endforeach
            @endif
        </div>
        <div>
        <form method="POST" action="{{ route('admin.roles.permissions', $role->id)}}">
            @csrf
         <div class="permissions-table">
            <div class="permissions-selection">
                <label for="permission" class="role-name">Permission</label>
                <select id="permission" name="permission" autocomplete="permission-name" class="role-input">
                    @foreach($permissions as $permission)
                    <option value="{{$permission->name}}">{{$permission->name}}</option>
                    @endforeach
                </select>
                @error('name') <span>{{$message}}</span> @enderror
            </div>
            <div class="btn-container">
                <button type="submit" class="btn-design">Assign Permission</button>
            </div>
        </div>
    </form>
        </div>
    </div>

</x-admin-layout>
