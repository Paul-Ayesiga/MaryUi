<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use Livewire\Attributes\Validate;
use App\Models\ClientAccount as CC;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Mary\Traits\Toast;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccountsExport;
// use Spatie\LaravelPdf\Facades\Pdf;

class ClientAccount extends Component
{
    use Toast;

    use WithPagination;

    public bool $addAccount = false;

    public bool $EditAccount = false;

    public bool $filtersDrawer = false;

    public bool $deleteModal = false;

    public bool $filledbulk = false;

    public bool $emptybulk = false;

    public string $search = '';

    public string $searchClientName = '';
    public ?string $filterAccountType = null;

    public ?CC $clientAccount;

    #[Validate('required')]
    public ? int $clientId = null;

    #[Validate('required')]
    public $accountType;

    public $perPage = 1;

    public array $selected = [];

    public array $sortBy = ['column' => ['id'], 'direction' => ['asc','desc']];

    public Collection $clients;

    public ?int $minBalance = 0;     // User-input minimum balance
    public ?int $balanceRange = 1000;
    public int $maxBalance;

    public array $activeFilters = [];


    public $columns = [
        'id' => true,
        'client.first_name' => true,
        'account_number' => true,
        'account_type' => true,
        'balance' => true,
    ];




    public function toggleColumnVisibility($column)
    {
        $this->columns[$column] = !$this->columns[$column];
    }


    public function mount()
    {
        // Set the highest balance in the database as the max balance
        $this->maxBalance = CC::max('balance');
        $this->balanceRange = $this->maxBalance;
        // Fill options when component first renders
        $this->searchClient();
        $this->updateActiveFilters();

    }

    public function clear():void{
        $this->search = '';
        $this->filterAccountType = '';
        $this->balanceRange = $this->maxBalance;
        $this->success('filters cleared ');
    }

    public function headers(): array
    {

            return collect([
                ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
                ['key' => 'client.first_name', 'label' => 'Owner', 'class' => 'w-64'],
                ['key' => 'account_number', 'label' => 'Account No', 'class' => 'w-20'],
                ['key' => 'account_type', 'label' => 'Account Type', 'sortable' => false],
                ['key' => 'balance', 'label' => 'Balance', 'sortable' => true],
            ])->filter(function ($header) {
                return $this->columns[$header['key']] ?? false;
            })->toArray();
    }

    // Reset pagination when any component property changes
    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
        $this->updateActiveFilters();
    }

    public function accounts(): LengthAwarePaginator
    {
        return CC::query()
        ->withAggregate('client', 'first_name')
        ->when($this->search, fn(Builder $q) => $q->where('account_number', 'like', "%$this->search%"))
        ->when($this->searchClientName, fn(Builder $q) => $q->whereHas('client', fn($q) => $q->where('first_name', 'like', "%$this->searchClientName%")))
        ->when($this->filterAccountType, fn(Builder $q) => $q->where('account_type', $this->filterAccountType))
        // ->when($this->balanceRange, fn(Builder $q) => $q->where('balance', '<=', $this->balanceRange))
          ->when($this->balanceRange, fn(Builder $q) => $q->whereBetween('balance', [$this->minBalance ?? 0, $this->balanceRange]))
        ->paginate($this->perPage);
    }

     // Method to count active filters
    public function activeFiltersCount(): int
    {
        $count = 0;

        if (!empty($this->search)) $count++;
        if(!empty($this->searchClientName)) $count++;
        if (!empty($this->filterAccountType)) $count++;
        if (!empty($this->minBalance)) $count++;
        if (!empty($this->balanceRange)) $count++;

        return $count;
    }

    // displaying active filters
    public function updateActiveFilters()
    {
        $this->activeFilters = [];

        if (!empty($this->search)) {
            $this->activeFilters['search'] = "Search: " . $this->search;
        }

        if (!empty($this->filterAccountType)) {
            $this->activeFilters['account_type'] = "Account Type: " . $this->filterAccountType;
        }

        if (!empty($this->minBalance)) {
            $this->activeFilters['min_balance'] = "Min Balance: " . $this->minBalance;
        }

        if (!empty($this->balanceRange)) {
            $this->activeFilters['balance_range'] = "Max Balance: " . $this->balanceRange;
        }
    }
    // remove single filter
    public function removeFilter($filter)
    {
        if ($filter == 'search') {
            $this->search = '';
        }

        if ($filter == 'account_type') {
            $this->filterAccountType = '';
        }

        if ($filter == 'min_balance') {
            $this->minBalance=null;
        }

        if ($filter == 'balance_range') {
            $this->balanceRange = null;
        }

        $this->updateActiveFilters();
        $this->resetPage();  // Reset pagination if necessary
    }
    // clear all filters
    public function clearAllFilters()
    {
        $this->search = '';
        $this->filterAccountType = '';
        $this->minBalance = null;
        $this->balanceRange = null;

        $this->updateActiveFilters();
        $this->resetPage();
    }

    // pdf export

//    public function exportToPDF()
// {
//     $data = CC::all(); // Adjust the query to fit your needs
//     $data = mb_convert_encoding($data, 'UTF-8', 'auto');
//     // Load view with encoded data
//     $pdf = Pdf::loadView('PDFs.accounts_table', ['accounts' => $data]);

//     return $pdf->download('accounts.pdf');

// }
public function exportToPDF()
{
    try {
        // Retrieve data from the database
        // $data = CC::all();

        // // Ensure data is in the correct format
        // $data = $data->map(function ($item) {
        //     return [
        //         'id' => mb_convert_encoding($item->id, 'UTF-8', 'auto'),
        //         'client_id' => mb_convert_encoding($item->client_id, 'UTF-8', 'auto'),
        //         'account_number' => mb_convert_encoding($item->account_number, 'UTF-8', 'auto'),
        //         'account_type' => mb_convert_encoding($item->account_type, 'UTF-8', 'auto'),
        //         'balance' => mb_convert_encoding($item->balance, 'UTF-8', 'auto'),
        //     ];
        // });

        $data=[
            'title' => 'hello'
        ];

        // Load the view for PDF generation
        $pdf = Pdf::loadView('PDFs.accounts_table', ['accounts' => $data]);
        // Download the PDF
        return $pdf->download('accounts.pdf');

    } catch (\Exception $e) {
        // // Log the error and return a response
        dd('PDF export error: ' . $e->getMessage());
        // return response()->json(['message' => 'An error occurred while generating the PDF'], 500);
    }
}



    public function exportToExcel()
    {
      if (count($this->selected) > 0) {
            // Export only selected accounts
            return Excel::download(new AccountsExport($this->selected), 'selected-accounts.xlsx');
        } else {
            // Export all accounts if none are selected
            return Excel::download(new AccountsExport(ClientAccount::all()), 'all-accounts.xlsx');
        }
    }

    // Delete action account
    public function delete($id): void
    {
        CC::destroy($id);
        $this->deleteModal = false;
        $this->success('Account deleted successfully');
    }

    public function bulk(){
        if(!empty($this->selected)){
            $this->filledbulk = true;
        }else{
            $this->emptybulk = true;
        }
    }
    // This method deletes selected items
    public function deleteSelected()
    {
        // Assuming you have a model for the items, e.g., Item::destroy($this->selected)
        CC::destroy($this->selected);

        // Reset the selected array after deletion
        $this->selected = [];

        // Optionally add some feedback to the user
        $this->filledbulk = false;
        $this->success('Selected Accounts deleted successfully');
    }

      // Delete edit account
    public function searchClient(string $value = '')
    {
        $selectedClient  = Client::where('id',$this->clientId)->get();

         $this->clients = Client::query()
            ->where('first_name', 'ilike', "%$value%")
            ->take(5)
            ->orderBy('first_name')
            ->get()
            ->merge($selectedClient);
    }

    function generateAccountNumber()
    {
        do {
             $accountNumber = 'ACC' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (CC::where('account_number', $accountNumber)->exists());

            return $accountNumber;
    }
    function createClientAccount()
    {
        $this->validate();
        $client = Client::findOrFail($this->clientId);

        $account = new CC();
           $account->client_id = $this->clientId;
           $account->account_number = $this->generateAccountNumber();
           $account->account_type = $this->accountType;
           $account->balance = 0.00;

           $account->save();

        $this->addAccount = false;
        $this->resetForm();
        $this->success('Account created successfully');
    }

    public function resetForm(){
        $this->clientId = null;
        $this->accountType = 'choose';
    }
    public function edit(CC $clientAccount){

        $this->clientAccount = $clientAccount;

        $this->clientId = $clientAccount->client_id;
        $this->accountType = $clientAccount->account_type;

        $this->EditAccount = true;
    }

    public function update(){
        $this->validate();

        $this->clientAccount->update(
            [
             'client_id' => $this->clientId,
            'account_type' => $this->accountType,
            ]
        );

        $this->EditAccount = false;
        $this->success('Account updated successfully');
    }
    public function render()
    {

        return view('livewire.client-account',[
            'accounts' => $this->accounts(),
            'headers' => $this->headers(),
            'selected' => $this->selected,
            'activeFiltersCount' => $this->activeFiltersCount(),
        ]);
    }
}
