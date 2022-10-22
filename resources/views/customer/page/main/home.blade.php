@extends('customer.layout.base')
@section('content')
@section('title', 'Home')

<!-- Hero -->
    {{-- <section class="relative"> --}}
        <div class="container flex flex-col flex-col-reverse lg:flex-row items-center gap-16 mt-10 mb-10 ml:14 px-10 py-10">
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
            <div class="box flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10">
                <img class=" h-5/6 sm:w-3/4 " src="dist/images/emptyCart.png" alt="" />
            </div>
        </div>
      <!-- Rounded Rectangle -->
    {{-- </section> --}}

@endsection
@push('scripts')
<script>
</script>
@endpush
