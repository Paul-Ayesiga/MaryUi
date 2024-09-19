<?php

namespace App\Livewire;

use App\Models\Loan;
use App\Models\LoanProduct;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Mary\Traits\Toast;
use App\Models\Client;


use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Api\SmsApi;

class Bulkdelete extends ModalComponent
{
    use Toast;
    public $loanIds = [];
    public $loanProductIds = [];


    public function mount()
    {
            if(!empty($loanIds)){
                $this->loanIds = $loanIds;

            }elseif(!empty($loanProductIds)){
                $this->loanProductIds = $loanProductIds;
            }
    }

    public function refreshLoanTable()
    {
        $this->dispatch('pg:eventRefresh-LoansTable');
    }

    public function refreshLoanProductTable()
    {
        $this->dispatch('pg:eventRefresh-LoanProductsTable');
    }
    public function confirmDelete()
    {
        if (!empty($this->loanIds)) {
            Loan::destroy($this->loanIds);

             // Notify clients about loan deletion
            foreach ($this->loanIds as $loanId) {
                $this->notifyClient($loanId);
            }


                // Clear the selection and refresh the interface
                $this->dispatch('pg:eventRefresh-LoansTable'); // Emit event to refresh the table if needed
                $this->js('window.pgBulkActions.clearAll()'); // Clear the selection count on the interface
                // $this->emit('closeModal'); // Close the modal after deletion
                $this->success('Loan Bulkdeletion successfully.', position: 'toast-top toast-end');
                $this->closeModal();
                $this->refreshLoanTable();

        }

        if(!empty($this->loanProductIds)){
            LoanProduct::destroy($this->loanProductIds);

                // Clear the selection and refresh the interface
                $this->dispatch('pg:eventRefresh-LoanProductsTable'); // Emit event to refresh the table if needed
                $this->js('window.pgBulkActions.clearAll()'); // Clear the selection count on the interface
                // $this->emit('closeModal'); // Close the modal after deletion
                $this->success('Loan Product Bulkdeletion successfully.', position: 'toast-top toast-end');
                $this->closeModal();
                $this->refreshLoanProductTable();
        }

    }


      public function notifyClient($loanId)
    {
        try {
            $loan = Loan::findOrFail($loanId);
            $client = Client::findOrFail($loan->client_id);
            $clientPhoneNumber = $client->phone;
            $from = "SMF";

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
                text: 'A loan under your credentials has been closed at Softech MicroFinance. If this was not your action, please call us at 0775364573.'
            );

            $request = new SmsAdvancedTextualRequest(messages: [$message]);

            $sendSmsApi->sendSmsMessage($request);

            $this->success('Notification sent to client.');
        } catch (ApiException $apiException) {
            $this->error($apiException->getMessage());
        } catch (\Exception $e) {
            $this->error('Failed to send notification: ' . $e->getMessage());
        }
    }
    public function cancelDelete(){
        // $this->info('Data is safe', position: 'toast-top toast-end');
            $this->toast(
            type: 'info',
            title: 'Data is safe',
            description: 'The action was not performed',                  // optional (text)
            position: 'toast-top toast-center',    // optional (daisyUI classes)
            icon: 'o-information-circle',       // Optional (any icon)
            css: 'alert-info shadow-lg text-white  rounded-sm',                // Optional (daisyUI classes)
            timeout: 3000,                      // optional (ms)
            redirectTo: null                    // optional (uri)
        );
        $this->closeModal();
    }

    public function render()
    {

        return view('livewire.bulkdelete');
    }
}
