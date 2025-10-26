<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Contactus;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    protected $rules = [
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'nullable|string|max:50',
        'message' => 'nullable|string',
      
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $data = $this->validate();
        Contactus::create($data);
        $this->reset(['name','email','phone','message']);
        $this->dispatchBrowserEvent('contact-sent', ['message' => __('Your message has been sent successfully!')]);
    }

    public function render()
    {
        return view('livewire.site.contact-form');
    }
}
