<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;
use App\Models\Loan;
use App\Models\LoanProduct;

class Dashboard extends Component
{
    use Toast;

    public string $search = '';

    public bool $addModal = false;

    public array $sortBy = ['column' => ['name'], 'direction' => ['asc','desc']];

    public array $selected = [];


    // public function mount(){

    // }

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    public function getGreeting()
    {
        $hour = date('H');

        if ($hour >= 5 && $hour < 12) {
            return "Good morning";
        } elseif ($hour >= 12 && $hour < 17) {
            return "Good afternoon";
        } elseif ($hour >= 17 && $hour < 21) {
            return "Good evening";
        } else {
            return "Good night";
        }
    }
    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): Collection
    {
        return collect([
            ['id' => 1, 'name' => 'Mary', 'email' => 'mary@mary-ui.com', 'age' => 23],
            ['id' => 2, 'name' => 'Giovanna', 'email' => 'giovanna@mary-ui.com', 'age' => 7],
            ['id' => 3, 'name' => 'Marina', 'email' => 'marina@mary-ui.com', 'age' => 5],
        ])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
            });
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'users' => $this->users(),
            'headers' => $this->headers(),
            'loans' => Loan::all(),
            'loanProducts' => LoanProduct::all(),
            'greeting' =>  $this->getGreeting(),

        ]);
    }
}
