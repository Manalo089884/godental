@extends('admin.layout.admin')
@section('content')
@section('title', 'Edit Role')
@livewire('form.permission-form',['role' => $role->id])


<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Permission  -->
    <div class="intro-y box mt-2 lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
              {{ $role->name }} - List of Permissions
            </h2>
            <div class="text-center">
                <a href="javascript:;"  data-tw-toggle="modal" data-tw-target="#add-item-modal" class="btn btn-primary w-full mr-1">
                    <i class="fa-solid fa-add w-4 h-4 mr-1"></i>Add Permissions
                </a>
            </div>
        </div>
        <div class="p-5">
            @if($role->permissions)
                @foreach ($role->permissions as $role_permission)
                    <form method="POST" action="{{ Route('roles.permissions.revoke',[$role->id,$role_permission->id]) }}" onsubmit="return confirm('Are you sure?')" class="btn btn-elevated-rounded-danger mr-1 mb-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit">{{ $role_permission->name }}  </button>
                    </form>
                @endforeach
            @endif
            <div class="flex justify-end mt-5">
                <a href="{{Route('role.index')}}" class="btn btn-outline-success  w-32 mr-1">Return</a>
            </div>
        </div>



    </div>


</div>



<div id="success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>

<div id="invalid-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-xmark fa-3x text-danger mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>


@endsection
@push('scripts')

<script>
    //Show Form Modal
    const myModal = tailwind.Modal.getInstance(document.querySelector("#add-item-modal"));
    window.addEventListener('OpenModal',event => {
        myModal.show();
    });
    //Hide Form Modal
    window.addEventListener('CloseModal',event => {
        myModal.hide();
    });
    //Closing Modal and Refreshing its value
    const myModalEl = document.getElementById('add-item-modal')
     myModalEl.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
    //SuccessAlert
    window.addEventListener('SuccessAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        Toastify({
            node: $("#success-notification-content") .clone() .removeClass("hidden")[0],
            duration: 7000,
            className: `toast-${id}`,
            newWindow: false,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true, }).showToast();

            const toast = document.querySelector(`.toast-${id}`)
            toast.querySelector("#title").innerText = event.detail.title
            toast.querySelector("#message").innerText = event.detail.name
        });
    //Invalid Alert
    window.addEventListener('InvalidAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        Toastify({
            node: $("#invalid-success-notification-content") .clone() .removeClass("hidden")[0],
            duration: 7000,
            newWindow: true,
            className: `toast-${id}`,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true, }).showToast();

            const toast = document.querySelector(`.toast-${id}`)
                toast.querySelector("#title").innerText = event.detail.title
                toast.querySelector("#message").innerText = event.detail.name
    });
</script>
@endpush
