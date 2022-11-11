@extends('customer.layout.base')
@section('content')
@section('title', 'Checkout')

<livewire:form.checkout-form/>
<livewire:modal.remove-checkout/>
@endsection
@push('scripts')
<script>
 //Delete Modal
 const RemoveToCheckoutModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#remove-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openRemoveModal',event => {
        RemoveToCheckoutModal.show();
        console.log('working');
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        RemoveToCheckoutModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('remove-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
</script>
@endpush
