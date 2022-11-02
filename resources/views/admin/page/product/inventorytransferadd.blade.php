@extends('admin.layout.admin')
@section('content')
@section('title', 'Create Transfer')
<div class="intro-y flex items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> Create Inventory Transfer
         </h2>
    </div>
</div>
<livewire:form.inventory-transfer-form/>

@endsection
@push('scripts')
@endpush
