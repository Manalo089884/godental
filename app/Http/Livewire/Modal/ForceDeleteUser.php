<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class ForceDeleteUser extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
        'forceCloseModal',
        'refreshChild' => '$refresh',
    ];

    public function forceCloseModal(){
        $this->cleanVars();
        $this->resetErrorBag();
    }

    private function cleanVars(){
        $this->modelId = null;
    }

    public function getModelDeleteModalId($modelId){
        $this->modelId = $modelId;
    }

    public function closeModal(){
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function delete(){
        abort_if(Gate::denies('user_forcedelete'),403);
        $user = User::onlyTrashed()->find($this->modelId);
        $user->forcedelete();
        $this->dispatchBrowserEvent('SuccessAlert',[
            'name' => $user->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.modal.force-delete-user');
    }
}