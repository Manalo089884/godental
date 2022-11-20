@extends('customer.layout.base')
@section('content')
@section('title', 'Profile Information')

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
             Welcome to Go Dental!
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('customer.component.side-profile')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Personal Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Personal Information
                    </h2>
                    @if(!Auth::guard('customer')->user()->email_verified_at)
                        <div class="dropdown">
                            <a href="{{ Route('customer.verify') }}" class="text-slate-500 leading-none">
                                Verify Account!
                            </a>
                        </div>
                    @endif

                </div>
                <div class="p-5">
                    @if(session('fail'))
                        <div class="alert alert-danger show mb-2 intro-x" role="alert">{{ session('fail') }}</div>
                    @endif
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <livewire:show.customer-profile/>
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class=" ">
                                    @if(!empty(Auth::guard('customer')->user()->photo))
                                        <img src="{{ url('storage/customer_profile_picture/'.Auth::guard('customer')->user()->photo.'') }}" class="rounded-md h-40 w-full object-fill"  alt="Missing Image" data-action="zoom">
                                    @else
                                        <img alt="Missing Image" class="rounded-md" src="{{asset('dist/images/undraw_pic.svg')}}" data-action="zoom">
                                    @endif
                                </div>
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    <button class="btn btn-primary w-full" data-tw-toggle="modal" data-tw-target="#change-profile-modal">
                                        Change Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Personal Information -->
            <!-- BEGIN: RECENT ORDERS -->
            <div class="intro-y box mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Recent Orders
                    </h2>
                </div>
                <div class="p-5">
                    <div class="overflow-x-auto">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th class="whitespace-nowrap">Order #</th>
                                    <th class="whitespace-nowrap text-center">Place On</th>
                                    <th class="whitespace-nowrap text-center">Items</th>
                                    <th class="whitespace-nowrap text-center">Total</th>
                                    <th class="whitespace-nowrap text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="whitespace-nowrap">489455921021952</td>
                                    <td class="whitespace-nowrap text-center">28/03/2022</td>
                                    <td class="whitespace-nowrap text-center">Toothpaste</td>
                                    <td class="whitespace-nowrap text-center">₱100.00</td>
                                    <td class="whitespace-nowrap text-center"><i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Show</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap">189455921021932</td>
                                    <td class="whitespace-nowrap text-center">12/04/2022</td>
                                    <td class="whitespace-nowrap text-center">Toothbrush</td>
                                    <td class="whitespace-nowrap text-center">₱120.00</td>
                                    <td class="whitespace-nowrap text-center"><i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Show</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap">789455921021952</td>
                                    <td class="whitespace-nowrap text-center">30/06/2022</td>
                                    <td class="whitespace-nowrap text-center">Toothpaste</td>
                                    <td class="whitespace-nowrap text-center">₱500.00</td>
                                    <td class="whitespace-nowrap text-center"><i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Show</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
             <!-- END: RECENT ORDERS -->
        </div>
    </div>
    <livewire:form.customer-change-profile-form/>
    <livewire:form.customer-change-information/>
@endsection
@push('scripts')
<script>
 const myModal = tailwind.Modal.getInstance(document.querySelector("#change-profile-modal"));
    //Hide Form Modal
    window.addEventListener('CloseModal',event => {
        myModal.hide();
    });
    //Closing Modal and Refreshing its value
    const myModalEl = document.getElementById('change-profile-modal')
     myModalEl.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });




    const informationModal = tailwind.Modal.getInstance(document.querySelector("#change-profile-information-modal"));
    window.addEventListener('openEditInformationModal',event => {
        informationModal.show();
    });

    //Hide Form Modal
    window.addEventListener('CloseInformationModal',event => {
        informationModal.hide();
    });
    //Closing Modal and Refreshing its value
    const infoModal = document.getElementById('change-profile-information-modal')
    infoModal.addEventListener('hidden.tw.modal', function(event) {
        console.log('wor')
        livewire.emit('ForceClose');
    });





</script>
@endpush
