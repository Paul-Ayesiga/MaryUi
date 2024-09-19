<?php

namespace App\Livewire;

use App\Livewire\Forms\LoanApplication;
// use App\Models\LoanApplication as LA;
use App\Models\LoanProduct;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Mary\Traits\Toast;
use Carbon\Carbon;

class AddLoan extends ModalComponent
{
    use WithFileUploads;
    public $loanProduct;
    use Toast;

     #[Validate('required|alpha')]
    public  $first_name;

    #[Validate('required|alpha')]
    public $last_name;

    #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $date_of_birth;

    #[Validate('required')]
    public $national_id;

    #[Validate('required|numeric|min:10')]
    public $phone_number;

    #[Validate('required')]
    public $address;

    #[Validate('required|alpha')]
    public $occupation;

    #[Validate('required|alpha')]
    public $income_source;

    #[Validate('required|alpha')]
    public $loan_purpose;

    #[Validate('required')]
    public $monthly_income;

    #[Validate('required')]
    public $loan_amount;

    #[Validate('required')]
    public $loan_term_months;

    #[Validate('required')]
    public $interest_rate;

    #[Validate('image')]
    public $passport_photo;
    // #[Validate('')]
    public $proof_asset;

    // public LoanApplication $form;

    public function mount(){
        // $this->loanProduct = LoanProduct::all();
    }

    public function save(){
        $this->validate();

        $imageName = Carbon::now()->timestamp . '.' .$this->passport_photo->extension();
       $photoPath =  $this->passport_photo->storeAs('applications', $imageName, 'public');

        LA::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'date_of_birth' => $this->date_of_birth,
                'national_id' => $this->national_id,
                'phone_number' => $this->phone_number,
                'address' => $this->address,
                'occupation' => $this->occupation,
                'income_source' => $this->income_source,
                'loan_purpose' => $this->loan_purpose,
                'monthly_income' => $this->monthly_income,
                'loan_amount' => $this->loan_amount,
                'loan_term_months' => $this->loan_term_months,
                'interest_rate' => $this->interest_rate,
                'passport_photo' => $photoPath,
                // 'proof_asset',
        ]);

            $this->success('Loan Added successfully.', position: 'toast-top toast-end');
            $this->closeModal();
            $this->reset();

    }

    public function render()
    {
        return view('livewire.add-loan',[
            'loanProducts' => $this->loanProduct
        ]);
    }
}
