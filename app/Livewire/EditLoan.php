<?php

namespace App\Livewire;

use App\Models\Loan;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
// use Infobip\Configuration;


class EditLoan extends ModalComponent
{
    public Loan $loan;
    public $first_name;

    public function mount(Loan $loan)
    {
    //     $configuration = new Configuration(
    //     host: 'your-base-url',
    //     apiKey: 'your-api-key'
    // );
        $this->loan = $loan;
        $this->first_name = $loan->client->first_name;
    }
    public function render()
    {
        return view('livewire.edit-loan');
    }
}
