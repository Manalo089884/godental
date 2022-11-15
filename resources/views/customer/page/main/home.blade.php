@extends('customer.layout.base')
@section('content')
@section('title', 'Home')
<div class="container box flex flex-col flex-col-reverse lg:flex-row items-center gap-16 mt-10 mb-10 ml:14 px-10 py-10">
    <!-- Content -->
    <div class="flex flex-1 flex-col items-center lg:items-start lg:pt-10">
        <h2 class="border-b-2 border-slate-400 text-5xl font-extrabold lg:text-5xl text-center lg:text-left mb-6">
            Go-Dental
        </h2>
        <p class="text-bookmark-grey text-lg text-center font-normal lg:text-left mb-6">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla scelerisque nisi a volutpat interdum.
            Sed viverra dui in nunc convallis, id facilisis tellus eleifend. Donec quis urna sit amet risus aliquam elementum eu at dui.
            Phasellus dictum posuere dignissim. Morbi lacus justo, varius at dolor at, mollis cursus orci.
        </p>
    </div>
    <!-- Image -->
    <div class="flex justify-center flex-1 w-full mb-5 md:mb-16 lg:mb-0 z-10">
        @if(count($banners) == 0)
            <img class=" h-5/6 sm:w-3/4 " src="{{ asset('dist/images/undraw_web_shopping.svg') }}" alt="" />
        @else
            <div class="home-mode" >
                @foreach ($banners as $banner)
                    <div class="h-72		 px-2">
                        <div class="h-full object-cover  rounded-md overflow-hidden"  >
                            <img class="object-fill w-96 h-full " data-action="zoom" src="{{ url('storage/banner/'.$banner->featured_image) }}" alt="" />
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

