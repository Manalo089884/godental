<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Illuminate\Support\Str;

use App\Models\User;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Laravolt\Avatar\Facade as Avatar;


class UserCreateForm extends Component
{
    use WithFileUploads;
    public $name,$email,$role,$password,$gender,$age,$address,$picture,$phone;

    protected function rules(){
        return [
            'name' => 'required|max:40',
            'address' => 'required|max:100',
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|phone:PH',
            'age' => 'required|numeric',
            'role' => 'required',

            'password' => 'required'

        ];
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required|max:40',
            'address' => 'required|max:100',
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|phone:PH',
            'age' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);
    }

    public function StoreUserData(){
        $this->validate();
        $imagename = $this->email.Str::random(10);




        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone,
            'address' => $this->address,
            'password' => $this->password,
            'photo' => $imagename,
            'gender' => $this->gender,
            'age' => $this->age,

        ];




        $user = User::create($data);
        $avatar = Avatar::create($this->name)->save(storage_path('app/public/photos/'.$imagename.'.png'));
        $user->assignRole($this->role);
        return redirect()->route('user.index')->with('success', $this->name .' was successfully inserted');
    }

    public function render()
    {
        $roles = Role::whereNotIn('name', ['Super Admin'])->get();

        return view('livewire.form.user-create-form',[
            'roles' => $roles
        ]);
    }
}
