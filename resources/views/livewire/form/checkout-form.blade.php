<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Personal Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Shipping Address
                    </h2>
                </div>
                <div class="p-5">
                    @foreach ($address as $address)
                        {{ $address->name }} - {{ $address->phone_number }}
                        {{ $address->province }}-{{ $address->city }}-{{ $address->barangay }}
                    @endforeach
                </div>
            </div>
            <!-- END: Personal Information -->
            <!-- BEGIN: RECENT ORDERS -->
            <div class="intro-y box mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Product Ordered
                    </h2>
                </div>
                <div class="p-5">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">Product Name</th>
                                    <th class="whitespace-nowrap">Price</th>
                                    <th class="whitespace-nowrap">Quantity</th>
                                    <th class="whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ $order->product->name }}</td>
                                        <td class="whitespace-nowrap">{{ $order->product->sprice }}</td>
                                        <td class="whitespace-nowrap">{{ $order->quantity }}</td>
                                        <td class="whitespace-nowrap">
                                            @if(count($orders)  == 1)
                                                <!-- BEGIN: Modal Toggle -->

                                                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#warning-modal-preview" class="text-danger">
                                                            <i class="fa-regular fa-trash-can w-4 h-4 mr-1" ></i> Remove
                                                        </a>

                                                <!-- END: Modal Toggle -->
                                                <!-- BEGIN: Modal Content -->
                                                <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <div class="p-5 text-center">
                                                                    <i class="fa-regular fa-circle-xmark fa-5x text-warning mx-auto mt-3"></i>
                                                                    <div class="text-3xl mt-5">Oops...</div>
                                                                    <div class="text-slate-500 mt-2">Something went wrong!</div>
                                                                </div>
                                                                <div class="px-5 pb-8 text-center">
                                                                    <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button>
                                                                </div>
                                                                <div class="p-5 text-center border-t border-slate-200/60 dark:border-darkmode-400">
                                                                    <a href="{{ Route('customer.profile') }}" class="text-primary">Your cart is empty! Please select item(s) before checkout</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END: Modal Content -->
                                            @else
                                                <button wire:click="selectItem({{ $order->id }},'remove')" class="flex items-center text-danger">
                                                    <i class="fa-regular fa-trash-can w-4 h-4 mr-1" ></i> Remove
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
             <!-- END: RECENT ORDERS -->
        </div>
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">

                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">Select Payment Method</div>
                    </div>

                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">


                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">

                        <h1 class="font-medium leading-none mt-1">Order Summary</h1>
                        <div class="flex justify-between mt-3">
                            <div>
                                <h1>Subtotal (items)</h1>
                            </div>
                            <div>
                                <h1>₱{{ number_format($subtotal)}}</h1>
                            </div>
                        </div>
                        <div class="flex justify-between mt-3 ">
                            <div>
                                <h1>Shipping Fee</h1>
                            </div>
                            <div>
                                <h1>₱{{ number_format($shippingfee ) }}</h1>
                            </div>
                        </div>
                        <div class="border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="flex justify-between mt-3 ">
                                <div>
                                    <h1 class="font-medium leading-none mt-1 mb-2">Total</h1>
                                </div>
                                <div>
                                    <h1>₱{{ number_format($total) }}</h1>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>
</div>
