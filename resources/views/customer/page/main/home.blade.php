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
                    A clean and simple interface to organize your favourite websites. Open a new browser tab and see your sites
                    load instantly. Try it for free.
                </p>
                <div class="flex flex-1 justify-center flex gap-6">
                    <button type="button" onclick="location.href='{{ Route('CLogin.index') }}'" class="intro-x btn btn-white hover:bg-bookmark-green hover:text-green">
                        Log in
                    </button>
                    <button type="button" onclick="location.href='{{ Route('CRegister.store') }}'" class="intro-x btn btn-primary hover:bg-bookmark-green hover:text-black">
                        Sign Up
                    </button>
                </div>
            </div>
            <!-- Image -->
            <div class="flex justify-center flex-1 mb-5 md:mb-16 lg:mb-0 z-10">
                @if(count($banners) == 0)
                    <img class=" h-5/6 sm:w-3/4 " src="{{ asset('dist/images/undraw_web_shopping.svg') }}" alt="" />
                @else
                    <div class="home-mode" >
                        @foreach ($banners as $banner)
                            <div class="h-64 px-2">
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
@push('scripts')
<script>
</script>
@endpush
