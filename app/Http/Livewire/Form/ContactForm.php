<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Alert;
use App\Jobs\ContactJob;

class ContactForm extends Component
{
    public $name,$email,$phone,$subject,$message;

    public function render()
    {
        return view('livewire.form.contact-form');
    }

    protected $validationAttributes = [
        'name' => 'Full Name',
        'email' => 'Email Address',
        'phone' => 'phone number',
        'subject' => 'Subject',
        'message' => 'Message'
    ];

    protected function rules(){
        return [
            'name'=> 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required|max:50',
            'message' => 'required|max:255',
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=> 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required|max:50',
            'message' => 'required|max:255',
        ]);
    }
    public function SendContactEmail(){
        $this->validate();
        $contact = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
        dispatch(new ContactJob($contact));
        Alert::success('Message Successfully Sent','' );
        return redirect()->route('contact');
    }
}
