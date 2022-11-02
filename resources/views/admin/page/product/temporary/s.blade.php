@extends('admin.layout.admin')
@section('content')
@section('title', 'Add Product')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Add Product
    </h2>
</div>
<div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
    <div class="intro-y col-span-12">
        <!-- Begin: Product Information -->
        <div class="intro-y box p-5">
            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Product Information  </div>
            <div class="mt-5">
                <!-- Product Title -->
                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                    <div class="form-label xl:w-64 xl:!mr-10">
                        <div class="text-left">
                            <div class="flex items-center">
                                <div class="font-medium">Product Name</div>
                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                            </div>
                            <div class="leading-relaxed text-slate-500 text-xs mt-3"> Include min. 40 characters to make it more attractive and easy for buyers to find, consisting of product type, brand, and information such as color, material, or type. </div>

                        </div>
                    </div>
                    <div class="w-full mt-3 xl:mt-0 flex-1">
                        <input id="product-name" type="text" class="form-control" placeholder="Product name">
                    </div>
                </div>
                <!-- END: Product Title -->

                 <!-- Begin: Category Name -->
                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                    <div class="form-label xl:w-64 xl:!mr-10">
                        <div class="text-left">
                            <div class="flex items-center">
                                <div class="font-medium">Category Name</div>
                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-3 xl:mt-0 flex-1">
                        <select id="category" class="form-select">
                            @forelse($categories as $category)
                                @if(old('category') == $category->id )
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @empty
                                <option disabled>No Results Found Add a Category first</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <!-- END: Category Name -->
                 <!-- Begin: Brand Name -->
                 <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                    <div class="form-label xl:w-64 xl:!mr-10">
                        <div class="text-left">
                            <div class="flex items-center">
                                <div class="font-medium">Brand Name</div>
                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-3 xl:mt-0 flex-1">
                        <select id="brand" class="form-select">
                            @forelse($brands as $brand)
                                @if(old('brand') == $brand->id )
                                    <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                @else
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endif
                            @empty
                                <option disabled>No Results Found Add a Brand first</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <!-- END: Brand Name -->
            </div>
            </div>
        </div>
        <!-- END: Product Information -->
        <!-- BEGIN: Product Detail -->
        <div class="intro-y box p-5 mt-5">
            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Product Detail </div>
                <div class="mt-5">

                    <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                        <div class="form-label xl:w-64 xl:!mr-10">
                            <div class="text-left">
                                <div class="flex items-center">
                                    <div class="font-medium">Product Description</div>
                                    <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                </div>
                                <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                    <div>Make sure the product description provides a detailed explanation of your product so that it is easy to understand and find your product.</div>
                                    <div class="mt-2">It is recommended not to enter info on mobile numbers, e-mails, etc. into the product description to protect your personal data.</div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 xl:mt-0 flex-1">
                            <textarea id="editor" class="editor" name="description" >{{old('description')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Product Detail -->
        <!-- Begin: Product Media -->
        <div class="intro-y box p-5 mt-5">
            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Media </div>
                <div class="mt-5">

                </div>
            </div>
        </div>
        <!-- End: Product Media -->

        <!-- Begin: Pricing -->
        <div class="intro-y box p-5 mt-5">
            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Pricing </div>
                <div class="mt-5">
                    <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                        <div class="form-label xl:w-64 xl:!mr-10">
                            <div class="text-left">
                                <div class="flex items-center">
                                    <div class="font-medium">Price</div>
                                    <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 xl:mt-0 flex-1">
                            <input id="product-stock" type="text" class="form-control" placeholder="Input Product Price">
                        </div>
                    </div>
                    <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                        <div class="form-label xl:w-64 xl:!mr-10">
                            <div class="text-left">
                                <div class="flex items-center">
                                    <div class="font-medium">Cost Per Item</div>
                                    <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 xl:mt-0 flex-1">
                            <input id="product-stock" type="text" class="form-control" placeholder="Input Product Price">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Pricing -->

        <!-- BEGIN: Product Management -->
        <div class="intro-y box p-5 mt-5">
            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Product Management </div>
                <div class="mt-5">
                    <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                        <div class="form-label xl:w-64 xl:!mr-10">
                            <div class="text-left">
                                <div class="flex items-center">
                                    <div class="font-medium">Product Status</div>
                                    <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                </div>
                                <div class="leading-relaxed text-slate-500 text-xs mt-3"> If the status is active, your product can be searched for by potential buyers. </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 xl:mt-0 flex-1">
                            <div class="form-check form-switch">
                                <input id="product-status-active" class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="product-status-active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                        <div class="form-label xl:w-64 xl:!mr-10">
                            <div class="text-left">
                                <div class="flex items-center">
                                    <div class="font-medium">Product Stock</div>
                                    <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 xl:mt-0 flex-1">
                            <input id="product-stock" type="text" class="form-control" placeholder="Input Product Stock">
                        </div>
                    </div>
                    <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                        <div class="form-label xl:w-64 xl:!mr-10">
                            <div class="text-left">
                                <div class="flex items-center">
                                    <div class="font-medium">SKU (Stock Keeping Unit)</div>
                                    <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                </div>
                                <div class="leading-relaxed text-slate-500 text-xs mt-3"> Use a unique SKU code if you want to mark your product. </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 xl:mt-0 flex-1">
                            <input id="sku" type="text" class="form-control" placeholder="Input SKU">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Product Management -->
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('dist/js/ckeditor-classic.js')}}"></script>


@endpush
