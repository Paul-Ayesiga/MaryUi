<?php
namespace App\Livewire;

use App\Events\LoanProductAdded;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\LoanProduct;
use Livewire\Attributes\Rule;
use Mary\Traits\Toast;
use App\Notifications\LoanProductAddedNotification;
use App\Models\User; // Or whichever model you want to notify

class LoanProducts extends Component
{
    use Toast;

    public bool $addLoanProduct = false;

    #[Validate('required|string')]
    public $name;

    #[Validate('required')]
    public $description;

    #[Validate('required|numeric')]
    public $amount;

    #[Validate('required|numeric')]
    public $interest_rate;

    #[Rule('required|gt:4|lt:13')]
    public int $term = 5;

    public function refreshTable()
    {
        $this->dispatch('pg:eventRefresh-LoanProductsTable');
    }

    public function save()
    {
        $this->validate();

        $loanProduct = LoanProduct::create([
            'name' => $this->name,
            'description' => $this->description,
            'max_amount' => $this->amount,
            'interest_rate' => $this->interest_rate,
            'term' => $this->term
        ]);

        $this->success('Loan Product saved successfully', position: 'toast-bottom');
        $this->addLoanProduct = false;
        $this->refreshTable();

        $message = 'A new loan product has been added!';
        $users = User::all(); // Notify all users or specific users

        foreach ($users as $user) {
            $user->notify(new LoanProductAddedNotification($loanProduct));
        }

        // Optionally, broadcast the event
       event(new LoanProductAdded([
         'message' => $message,
       ]));
    }

    public function render()
    {
        return view('livewire.loan-products');
    }
}
