<div style="height: 550px; overflow-y:scroll; overflow-x:hidden">
    <div class="breadcrumbs text-sm mb-2">
        <ul>
            <li><a>Home</a></li>
            <li><a>Accounts</a></li>
            <li>view Accounts</li>
        </ul>
    </div>


    <br>
        <x-mary-header title="Overview of Accounts DataTable" class="text-4xl text-center mb-20"  separator progress-indicator ... >
            <x-slot:actions>
                <x-mary-button label="Add Account" @click="$wire.addAccount = true"  icon="o-plus" class="bg-blue-700 dark:bg-blue-300 dark:text-black mb-3 text-white rounded-md mr-10" />
            </x-slot:actions>
        </x-mary-header>
        <div class="inline-flex flex-wrap">
            <x-mary-button label="Bulk?" icon="o-trash"  class="btn-error btn-sm  mx-3" wire:click="bulk" />
            <x-mary-button label="" icon="o-funnel"  class="btn-warning btn-sm mx-2 rounded-md"
            {{-- @click="$wire.filtersDrawer= true" --}} wire:click="$set('filtersDrawer', true)"
            badge="{{$activeFiltersCount}}" />
            <x-mary-button wire:click="exportToPDF" label="PDF" class="btn-primary btn-sm rounded-md mx-1"/>
            <x-mary-button wire:click="exportToExcel" label="XLS" class="btn-primary btn-sm mx-2"/>

            <div class="mb-4 sm: mt-3">
                <!-- Dropdown for toggling columns -->
                <x-mary-dropdown>
                    <x-slot name="trigger">
                        <x-mary-button label="" icon="o-eye" class="btn-warning btn-sm" />
                    </x-slot>
                         @foreach(['id', 'client.first_name', 'account_number', 'account_type', 'balance'] as $column)
                            <x-mary-menu-item wire:click="toggleColumnVisibility('{{ $column }}')">
                                @if($columns[$column])
                                    {{-- Icon for visible column --}}
                                    <x-mary-icon name="o-eye" class="text-green-500" />
                                @else
                                    {{-- Icon for hidden column --}}
                                    <x-mary-icon name="o-eye-slash" class="text-gray-500" />
                                @endif
                                <span class="ml-2">{{ ucfirst(str_replace('_', ' ', $column)) }}</span>
                            </x-mary-menu-item>
                        @endforeach

                </x-mary-dropdown>
            </div>
        </div>

        <div class="mb-4 mt-5">
            @if(count($activeFilters) > 0)
                <x-mary-button wire:click="clearAllFilters" label="Clear All Filters" class="mt-2 btn-danger btn-sm"/>
            @endif
            <div class="flex flex-wrap gap-2">
                @foreach($activeFilters as $filter => $value)
                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-full mt-3">
                        {{ $value }}
                        <button type="button" wire:click="removeFilter('{{ $filter }}')" class="ml-2 text-white hover:text-gray-300">
                            &times;
                        </button>
                    </span>
                @endforeach
            </div>
        </div>

        {{-- when selected bulk deletion modal --}}
            <x-mary-modal wire:model="filledbulk"  title="Bulk Deletion yet To Happen" subtitle="" separator>
                <div>
                    Are you sure? , you want to perform this action, its irreversible
                </div>
                <x-slot:actions>
                    <x-mary-button label="Cancel" @click="$wire.filledbulk = false" />
                    <x-mary-button label="Delete" wire:click="deleteSelected" class="bg-red-600 rounded-md text-white font-bold" spinner/>
                </x-slot:actions>
            </x-mary-modal>
        {{-- when selected bulk deletion modal --}}
            <x-mary-modal wire:model="emptybulk"  title="Ooops! No rows selected " subtitle="" separator>
                <div>
                    Select some rows to delete
                </div>
                <x-slot:actions>
                    <x-mary-button label="Okay" @click="$wire.emptybulk = false" class="btn btn-accent" />
                </x-slot:actions>
            </x-mary-modal>
        {{-- end of bulk delete modal --}}
        <x-mary-table :headers="$headers" :rows="$accounts" :sort-by="$sortBy" with-pagination  per-page="perPage"
        :per-page-values="[1,3, 5, 10]"  wire:model="selected" selectable>
            {{-- Special `actions` slot --}}
            @scope('actions', $account)
                <div class="inline-flex">
                    <x-mary-button icon="o-pencil" wire:click="edit({{ $account->id }})" spinner class="btn-sm bg-orange-300" />
                    <x-mary-button icon="o-trash"  @click="$wire.deleteModal = true" spinner class="btn-sm bg-red-600" />
                </div>


                {{-- single accountdelete modal --}}
                <x-mary-modal wire:model="deleteModal" title="Deletion yet To Happen" subtitle="" separator>
                    <div>
                        Are you sure? , you want to perform this action, its irreversible
                    </div>
                    <x-slot:actions>
                        <x-mary-button label="Cancel" @click="$wire.deleteModal = false" />
                        <x-mary-button label="Delete" wire:click="delete({{$account->id}})" class="bg-red-600 rounded-md text-white font-bold" spinner/>
                    </x-slot:actions>
                </x-mary-modal>
                {{-- end --}}
            @endscope
            <x-slot:empty>
                <x-mary-icon name="o-cube" label="It is empty." />
            </x-slot:empty>
        </x-mary-table>



    {{-- adding Account drawer --}}
    <x-mary-drawer wire:model="addAccount" title="Add Account" right>
        <div>
            <x-mary-form wire:submit="createClientAccount">
                 <x-mary-choices label="Clients" wire:model="clientId" :options="$clients" single searchable class="mb-5">
                        @scope('item', $client)
                            <x-mary-list-item :item="$client" sub-value="last_name">
                                <x-slot:avatar>
                                    <x-mary-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full" />
                                </x-slot:avatar>
                                <p>{{$client->first_name}}</p>
                                <x-slot:actions>
                                    <x-mary-badge :value="$client->first_name" />
                                </x-slot:actions>
                            </x-mary-list-item>
                        @endscope

                        @scope('selection', $client)
                            {{ $client->first_name }} ({{ $client->last_name }})
                        @endscope
                </x-mary-choices>
                   <select class="select select-primary w-full max-w-xs" wire:model="accountType">
                        <option selected>Choose account type</option>
                        <option value="deposit">Deposit</option>
                        <option value="savings">Savings</option>
                        <option value="loans">Loans</option>
                        <option value="investment">Investment</option>
                    </select>
                    @error('accountType')
                       <p class="text-error">{{$message}}</p>
                    @enderror
                <x-slot:actions>
                    {{-- Notice `onclick` is HTML --}}
                    <x-mary-button label="Cancel" @click="$wire.addAccount = false" />
                    <x-mary-button label="Create Account" class="btn-primary" type="submit" spinner="createClientAccount"  />
                </x-slot:actions>
            </x-mary-form>
        </div>
    </x-mary-drawer>
    {{-- end of account drawer --}}

      {{-- editing Account drawer --}}
    <x-mary-drawer wire:model="EditAccount" title="Edit Account" right>
        <div>
            <x-mary-form wire:submit="update">
                <x-mary-input label="Client ID" placeholder="Client ID" icon="" hint="Input your Client ID"  wire:model="clientId" type="number" min="1"/>
                   <select class="select select-primary w-full max-w-xs" wire:model="accountType">
                        <option disabled selected>Choose account type</option>
                        <option value="deposit">Deposit</option>
                        <option value="savings">Savings</option>
                        <option value="loans">Loans</option>
                        <option value="investment">Investment</option>
                    </select>
                <x-slot:actions>
                    {{-- Notice `onclick` is HTML --}}
                    <x-mary-button label="Cancel" @click="$wire.EditAccount = false" />
                    <x-mary-button label="Edit Account" class="btn-primary" type="submit" spinner="update"  />
                </x-slot:actions>
            </x-mary-form>
        </div>
    </x-mary-drawer>
    {{-- end of account drawer --}}

    {{-- adding filter drawer --}}
    <x-mary-drawer wire:model="filtersDrawer" title="Filters" right>
        <div>
            <x-mary-input label="Account No"  placeholder="Search .." wire:model.live.debounce="search" clearable icon="o-magnifying-glass"/><br>

             <!-- New Filters -->
            <x-mary-input label="Client Name" placeholder="Search by Client Name" wire:model.live.debounce="searchClientName" clearable icon="o-user" /><br>

            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Account Type</span>
                </div>
                <select label="Account Type" wire:model.live="filterAccountType" class="select select-bordered w-full max-w-xs mb-5">
                    <option value="">All Types</option>
                    <option value="savings">Savings</option>
                    <option value="investment">Investment</option>
                    <option value="deposit">Deposit</option>
                    <option value="loans">Loans</option>
                </select><br>
            </label>

                <!-- Balance Slider -->
                <div>
                    <label for="balanceRange" class="block font-medium text-sm text-gray-700">Balance Range</label>
                    <input type="range" wire:model.live="balanceRange" id="balanceRange" min="0" max="{{$maxBalance}}" step="10" class="w-full" />
                    <span class="block mt-0">Selected Balance: UGX {{ $balanceRange }}</span>
                </div>
                  <!-- Min and Max Balance Range Input Fields -->
                <div class="mb-4 flex justify-between space-x-4 mt-3">
                    <div>
                        <label for="minBalance" class="block font-medium text-sm text-gray-700">Min Balance</label>
                        <input
                            type="number"
                            wire:model.live.debounce.500s="minBalance"
                            id="minBalance"
                            min="0"
                            max="{{ $balanceRange }}"
                            class="w-full border border-gray-300 rounded-lg p-2"
                            placeholder="Enter minimum balance"
                        />
                    </div>

                    <div>
                        <label for="maxBalance" class="block font-medium text-sm text-gray-700">Max Balance</label>
                        <input
                            type="number"
                            wire:model.live.debounce.500s="maxBalance"
                            id="maxBalance"
                            min="{{ $minBalance }}"
                            max="{{ $balanceRange }}"
                            class="w-full border border-gray-300 rounded-lg p-2"
                            placeholder="Enter maximum balance"
                        />
                    </div>
                </div>

                <x-slot:actions>
                    {{-- Notice `onclick` is HTML --}}
                    <x-mary-button label="reset" wire:click="clear" />
                    <x-mary-button label="Filter" class="btn-primary" type="submit" spinner=""  />
                </x-slot:actions>

        </div>
    </x-mary-drawer>
    {{-- end of filters drawer --}}
</div>
