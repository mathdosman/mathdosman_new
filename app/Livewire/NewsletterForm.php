<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber;

class NewsletterForm extends Component
{
    public $email = '';

    protected $rules = [
        'email' => 'required|email|unique:newsletter_subscribers,email'
    ];

    protected function message()
    {
        return [
            'email.required' => 'Please enter your email addres.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.'
        ];
    }

    public function updatedEmail()
    {
        $this->validateOnly('email');
    }

    public function subscribe()
    {
        $this->validate();

        NewsletterSubscriber::create(['email' => $this->email]);

        $this->email = '';

        session()->flash('success', 'You have been successfully subscribed.');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}