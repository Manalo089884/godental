@extends('admin.layout.admin')
@section('content')
@section('title', 'Edit Role')


<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Supplier  -->
    <div class="intro-y box mt-2 lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Edit Role - {{ $role->name }}
            </h2>
        </div>

        <form method="POST" action="{{ Route('role.update',$role) }}">
            @method('put')
            @csrf
            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 ">
                        <div>
                            <label for="name" class="form-label">Role Name</label>
                            <input name="name" type="text" placeholder="Please Enter Role Name" class="form-control @error('name') border-danger @enderror" value="{{old('name') ?? $role->name}}" >
                            <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <a href="{{Route('role.index')}}"><button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button></a>
                    <button type="submit" class="btn btn-primary w-24 mt-3">Edit</button>
                </div>
            </div>
        </form>
    </div>

    <div class="intro-y box mt-2 lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                List of Permission
            </h2>
        </div>
        <div class="p-5">
            <div class="flex space-x-2 mb-1">
                @if($role->permissions)
                    @foreach ($role->permissions as $role_permission)
                        <form method="POST" action="{{ Route('roles.permissions.revoke',[$role->id,$role_permission->id]) }}" onsubmit="return confirm('Are you sure?')" class="btn btn-elevated-rounded-danger w-full mr-1 mb-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit">{{ $role_permission->name }}  </button>
                        </form>
                    @endforeach
                @endif
            </div>

            <form action="{{ Route('roles.permissions',$role->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 ">
                        <div>
                            <label for="permission" class="form-label">Permissions</label>
                            <select id="permission" name="permission" class="form-select">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24 mt-3">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>






@endsection
@push('scripts')

@endpush
