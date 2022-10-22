@extends('admin.layout.admin')
@section('content')
@section('title', 'Create New Role')


<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Supplier  -->
    <div class="intro-y box mt-2 lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Create New Role
            </h2>
        </div>

        <form method="POST" action="{{ Route('role.store') }}">
            @csrf
            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 ">
                        <div>
                            <label for="name" class="form-label">Role Name</label>
                            <input name="name" type="text" placeholder="Please Enter Role Name" class="form-control @error('name') border-danger @enderror"  value="{{ old('name') }}" >
                            <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <a href="{{Route('role.index')}}"><button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button></a>
                    <button type="submit" class="btn btn-primary w-24 mt-3">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>






@endsection
@push('scripts')

@endpush
