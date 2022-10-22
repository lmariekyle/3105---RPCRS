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

    <form method="POST" action="{{ route('admin.roles.store') }}">
    <div class="roles-table">
            @csrf
            <div class="roles-form">
                <label for="name" class="role-name">Role Name</label>
                <div class="role-input">
                    <input type="text" id="name" name="name">
                </div>
                @error('name') <span>{{$message}}</span> @enderror
            </div>
            <div class="btn-container">
                <button type="submit" class="btn-design">Create Role</button>
            </div>
    </div>
    </form>

</x-admin-layout>
<style>
        .rolesActive{
            background: white;
            border-radius:8px;
        }
</style>