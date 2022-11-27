@extends('customer.layout.base')
@section('content')
@section('title', 'Home')
<!-- Begin: Main Container -->
<div class="container box flex flex-col flex-col-reverse lg:flex-row items-center gap-16 mt-10 mb-10 ml:14 px-10 py-10">
    <!-- Begin: Message Content -->
    <div class="flex flex-1 flex-col items-center lg:items-start lg:pt-10">
        <h2 class="border-b-2 border-slate-400 text-5xl font-extrabold lg:text-5xl text-center lg:text-left mb-6">
            Go-Dental
        </h2>
        <p class="mb-6 text-2xl italic font-light text-center text-bookmark-grey md:text-left">
            All your Dental needs in One Go! Shop Now
        </p>
    </div>
    <!-- End: Message Content -->
    <!-- Begin: Display Image -->
    <div class="flex justify-center flex-1 w-full mb-5 md:mb-16 lg:mb-0 z-10">
        @if(count($banners) == 0)
            <img class=" h-5/6 sm:w-3/4 " src="{{ asset('dist/images/undraw_web_shopping.svg') }}" alt="" />
        @else
            <div class="home-mode" >
                @foreach ($banners as $banner)
                    <div class="h-72 px-2">
                        <div class="h-full object-cover  rounded-md overflow-hidden"  >
                            <img class="object-fill w-96 h-full " data-action="zoom" src="{{ url('storage/banner/'.$banner->featured_image) }}" alt="" />
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- End: Display Image -->
</div>
@endsection

