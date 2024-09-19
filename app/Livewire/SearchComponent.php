<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchComponent extends Component
{
    public $query = '';
    public $showModal = false;
    public $branches = [];

    public function updatedQuery()
    {
        if (empty($this->query)) {
            // Hide the modal when the query is cleared
            $this->showModal = false;
            $this->branches = [];
        } else {
            // Show the modal when the user starts typing
            $this->showModal = true;

            // Search branches based on the query
            $this->branches = User::where('first_name', 'ilike', '%' . $this->query . '%')->get();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.search-component');
    }
}
