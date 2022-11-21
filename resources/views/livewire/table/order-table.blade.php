<div>
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <div class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="flex-none xl:w-auto xl:flex-initial mr-2">Sort</label>
                    <select  class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <option value="nameaz" >Default Sorting</option>
                        <option value="nameza">Sort by newness</option>
                        <option value="createdold">Sort by price: low to high</option>
                        <option value="creatednew">Sort by price: high to low</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                    <input  type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                </div>
            </div>
            <div class="flex mt-5 sm:mt-0">
                <div class="dropdown w-1/2 sm:w-auto">
                    <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa-regular fa-newspaper w-4 h-4 mr-2"></i> Export <i class="fa-solid fa-chevron-down w-4 h-4 ml-auto sm:ml-2"></i> </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="{{Route('exportproductexcel')}}" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export Excel </a>
                            </li>
                            <li>
                                <a  href="{{Route('exportproductcsv')}}" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export CSV </a>
                            </li>
                            <li>
                                <a href="{{Route('exportproductpdf')}}" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export PDF </a>
                            </li>
                            <li>
                                <a  href="{{Route('exportproducthtml')}}" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export HTML </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       <div class="overflow-x-auto scrollbar-hidden">

           <div class="overflow-x-auto">
               <table class="table mt-5" >
                   <thead class="table-dark">
                       <tr>
                           <th class="whitespace-nowrap">Products</th>
                           <th class="whitespace-nowrap text-center">Order Total</th>
                           <th class="whitespace-nowrap text-center">Status</th>
                           <th class="whitespace-nowrap text-center">Actions</th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach ($orders as $order)
                        <tr class="bg-slate-300">
                            <td colspan="3">{{ $order['order']->customers->name }}</td>
                            <td colspan="1" class="whitespace-nowrap text-center">

                                        Order ID: {{ $order['order']->id }}
                            </td>
                        </tr>
                        @foreach ($order['products'] as $index => $item)
                            @if($item->customer_orders_id == $order['order']->id)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                @if($index == 0)
                                <td class="whitespace-nowrap text-center" rowspan="{{count($order['products']) }}">
                                    <div>₱{{$order['total']}}</div>
                                    <div>{{ $item->customer_orders->mode_of_payment }}</div>
                                </td>

                                    <td class="whitespace-nowrap text-center" rowspan="{{count($order['products']) }}">{{ $item->customer_orders->status }}</td>
                                    <td class="whitespace-nowrap text-center" rowspan="{{count($order['products']) }}">Check Details</td>
                                @endif
                            </tr>
                            @endif
                        @endforeach
                    @endforeach
                   </tbody>
               </table>
           </div>
           <!-- No Result -->
           <!-- To Be Applied Once Their is orders table
           <h2 class="intro-y text-lg font-medium mt-10">
               No Results found <strong></strong>
           </h2>
        -->

       </div>

       <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
           <nav class="w-full sm:w-auto sm:mr-auto">

           </nav>
           <div class="mx-auto text-slate-500">
            Showing 0 to 0 of 100 entries
        </div>
           <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
               <option>10</option>
               <option>25</option>
               <option>35</option>
               <option>50</option>
           </select>
       </div>
    </div>
</div>
