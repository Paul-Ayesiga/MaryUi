<?php

namespace App\Livewire;

use App\Enums\Status;
use App\Enums\State;
use App\Models\Loan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Helpers\PowerGridThemes\TailwindHeaderFixed;
use App\Helpers\PowerGridThemes\TailwindStriped;
use Mary\Traits\Toast;


final class LoansTable extends PowerGridComponent
{
    use WithExport;
    use Toast;

    // protected $listeners = ['bulkdelete' => 'bulkdelete'];

    public  $amount;
    public bool $showErrorBag = true;
    // public bool $addLoan = false;

    public string $tableName = 'LoansTable';
    public bool $deferLoading = true;
    public string $loadingComponent = 'components.my-custom-loading';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Header::make()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                // ->slot('Bulk Delete')
                ->slot(__('Bulk delete (<span x-text="window.pgBulkActions.count(\'' . $this->tableName . '\')"  wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"></span>)'))
                ->class('cursor-pointer block bg-red-700 rounded-lg btn-sm text-white px-2 py-1')
                // ->dispatch('bulkDelete.'. $this->tableName, [])
                ->openModal('bulkdelete' ,['loanIds' => $this->checkboxValues]),
        ];
    }

    public function datasource(): Builder
    {
        return Loan::query()->with(['loanProduct','client']);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('Borrower', fn ($client) => e($client->client->first_name))
            ->add('loan_product', fn ($LoanProduct) => e($LoanProduct->loanProduct->name))
            ->add('amount')
            ->add('interest_rate')
            ->add('term')
            ->add('status')
            ->add('state')
            ->add('state', fn ($loan) => $loan->state ? 'active' : 'inactive')
            ->add('application_date_formatted', fn (Loan $model) => Carbon::parse($model->application_date)->format('d/m/Y'))
            ->add('approval_date_formatted', fn (Loan $model) => Carbon::parse($model->approval_date)->format('d/m/Y'))
            ->add('disbursement_date_formatted', fn (Loan $model) => Carbon::parse($model->disbursement_date)->format('d/m/Y'))
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

            Column::make('Borrower', 'Borrower')
                ->sortable()
                ->searchable(),

            Column::make('Loan product', 'loan_product')
                ->sortable()
                ->searchable(),

            Column::make('Amount', 'amount')
                ->sortable()
                ->searchable()
                ->editOnClick(hasPermission: true, dataField: 'amount'),

            Column::make('Interest rate', 'interest_rate')
                ->sortable()
                ->searchable(),

            Column::make('Term', 'term')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('State', 'state')
                ->sortable()
                ->searchable()
                ->toggleable(hasPermission: true, trueLabel: 'yes', falseLabel: 'no'),

            Column::make('Application date', 'application_date_formatted', 'application_date')
                ->sortable(),

            Column::make('Approval date', 'approval_date_formatted', 'approval_date')
                ->sortable(),

            Column::make('Disbursement date', 'disbursement_date_formatted', 'disbursement_date')
                ->sortable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
                ->fixedOnResponsive()
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('application_date'),
            Filter::datepicker('approval_date'),
            Filter::datepicker('disbursement_date'),
            Filter::number('amount')->thousands(','),
            Filter::enumSelect('status', 'loans.status')
                ->dataSource(Status::cases())
                ->optionLabel('status'),
            Filter::enumSelect('state', 'loans.state')
                ->dataSource(State::cases())
                ->optionLabel('state'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Loan $row): array
    {
        return [
            Button::add('preview')
                ->slot('
                    <button wire:navigate href="' . route('loans.show', ['id' => $row->id]) . '"
                            class="text-white bg-blue-500 px-1 py-1 font-bold rounded dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="white" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                            <path stroke="white" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </button>
                ')
                ->id()
                ->route('loans.show',['id' => $row->id])
                ->method('get'),

            Button::add('edit')
                ->slot('<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                    </svg>
                    ')
                ->id()
                ->class('text-white bg-orange-500 px-1 py-1 font-bold  rounded dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                // ->dispatch('edit', ['rowId' => $row->id]),
                ->openModal('edit-loan', ['loan' => $row->id]),
             Button::add('delete')
                ->slot('<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                        </svg>
                    ')
                ->id()
                ->class('text-white bg-red-800 px-1 py-1 font-bold rounded dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }*/

    // #[On('bulkDelete.{tableName}')]
    public function bulkDelete($loanIds)
    {

    }

     public function template(): ?string
    {
        return TailwindHeaderFixed::class;
        return TailwindStriped::class;
    }

    protected function rules()
    {
        return [
            'amount' =>  'required',
        ];
    }
    protected function validationAttributes()
    {
        return [
            'amount' => 'Loan amount',
        ];
    }
    protected function messages()
    {
        return [
            'amount.required' => 'amount cant be empty',
        ];
    }

    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {
        $this->validate();
        Loan::query()->find($id)->update([
            $field => e($value),
        ]);
    }

    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        $value = ($value === '1') ? 'active' : 'inactive';
        Loan::query()->find($id)->update([
            $field => e($value),
        ]);

        $this->skipRender();
    }
}
