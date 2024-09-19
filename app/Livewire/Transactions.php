<?php

namespace App\Livewire;

use Livewire\Component;


use App\Models\ClientAccount;
use App\Models\Transactions as ModelsTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Mary\Traits\Toast;

class Transactions extends Component
{
    use toast;
    public ?int $from_account_id = null;

    public ?int $to_account_id = null;

    public $amount;

    public Collection $client_accounts;

    public $errorCheck;



    public function mount()
    {
        // Load all accounts to populate the select dropdowns
        $this->client_accounts = ClientAccount::all();
    }

    public function makeTransaction()
    {
        $this->validate([
            'amount' => 'required|numeric|min:0.01',
            'from_account_id' => 'required|exists:client_accounts,id',
            'to_account_id' => 'required|exists:client_accounts,id',
        ]);



            $fromAccount = ClientAccount::findOrFail($this->from_account_id);
            $toAccount = ClientAccount::findOrFail($this->to_account_id);


            // Ensure the from and to accounts are different
            if ($this->from_account_id === $this->to_account_id) {
                $this->error('sender and receiver accounts cant be the same');
                return $this->errorCheck;
            }

            if ($fromAccount->balance < $this->amount) {
                $this->error('insufficient funds');
                return $this->errorCheck;
            }

            if(!$this->errorCheck){

            $fromAccount->balance -= $this->amount;
            $toAccount->balance += $this->amount;

            $fromAccount->save();
            $toAccount->save();


            // Perform the transaction
            ModelsTransactions::create([
                'amount' => $this->amount,
                'from_account_id' => $this->from_account_id,
                'to_account_id' => $this->to_account_id,
                'status' => 'completed'
            ]);

            $this->success('successful transaction');

        }

    }
    public function render()
    {
        return view('livewire.transactions');
    }
}
