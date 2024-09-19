<?php

namespace App\Livewire;

use App\Models\LoanProduct;
use App\Models\Loan;
use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Collection;
use Mary\Traits\Toast;

use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Api\SmsApi;

class Loans extends Component
{
    use Toast;
    public bool $addLoan = false;

    public ?int $loan_product_id = null;

    public ?int $client_id = null;

    public LoanProduct $loanproduct;

    public Collection $loanProductSearchable;

    public Collection $clients;

    public $payment_frequency;

    public function mount()
    {
        // Fill options when component first renders
        $this->search();
    }

    public function search(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = LoanProduct::where('id', $this->loan_product_id)->get();

        $this->loanProductSearchable = LoanProduct::query()
            ->where('name', 'like', "%$value%")
            ->take(5)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option

        $selectedClient  = Client::where('id',$this->client_id)->get();

         $this->clients = Client::query()
            ->where('first_name', 'ilike', "%$value%")
            ->take(5)
            ->orderBy('first_name')
            ->get()
            ->merge($selectedClient);
    }

    public function refreshTable()
    {
        $this->dispatch('pg:eventRefresh-LoansTable');
    }



    public function save()
    {
        $this->validate([
            'loan_product_id' => 'required|exists:loan_products,id',
            'client_id' => 'required|exists:clients,id',
            'payment_frequency' => 'required|in:weekly,bi-weekly,monthly',
        ]);

        // Retrieve the selected loan product to set the amount
        $loanProduct = LoanProduct::findOrFail($this->loan_product_id);

        $loan = new Loan();
        $loan->loan_product_id = $this->loan_product_id;
        $loan->client_id = $this->client_id;
        $loan->amount = $loanProduct->max_amount;
        $loan->interest_rate = $loanProduct->interest_rate;
        $loan->term = $loanProduct->term;
        $loan->payment_frequency = $this->payment_frequency;
        // Add other loan attributes as needed

        $loan->save();
        $this->addLoan = false;
        // $this->reset(); // Reset form fields
        $this->refreshTable();


    // sending an sms to the borrowers number


    $client = Client::findOrFail($this->client_id);
    $clientPhoneNumber = $client->phone;
    $from = "Softech";

        $configuration = new Configuration(
            host: 'e58k13.api.infobip.com',
            apiKey: 'f6ab3f25fdae9e077916f868ecaa6406-8f5ee971-a554-4d30-a756-0f51923cc73c'
        );


         $sendSmsApi = new SmsApi(config: $configuration);

        $message = new SmsTextualMessage(
            destinations: [
                new SmsDestination(to: $clientPhoneNumber)
            ],
            from: $from,
            text: 'A loan has been issued under your credetials at Softech MicroFinance, if this action wasnt your intent, Call Us on 0775364573'
        );

        $request = new SmsAdvancedTextualRequest(messages: [$message]);

        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);
            $this->success('Loan saved & Sms sent to Customer successfully');
        } catch (ApiException $apiException) {
            $this->error($apiException->getMessage());
        }
        }
    public function render()
    {
        return view('livewire.loans');
    }
}
