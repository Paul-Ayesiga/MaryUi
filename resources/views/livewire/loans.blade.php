
<div style="height: 550px; overflow:scroll;">
    <div class="breadcrumbs text-sm mb-2">
        <ul>
            <li><a>Home</a></li>
            <li><a>Loans</a></li>
            <li>view loans</li>
        </ul>
    </div>
    {{-- <div>
        <div class="hero bg-base-200 h-45 bg-gradient-to-r from-blue-700 to-white p-4 rounded">
            <div class="hero-content flex-col lg:flex-row-reverse">
                <img
                src="{{asset('banners/banner3.png')}}"
                class="max-w-xs rounded-lg shadow-2xl hidden sm:flex" />
                <div>
                <h1 class="text-5xl font-bold dark:text-white text-slate-200 sm:mr-5">Hello Softech Community!</h1>
                <p class="py-6 dark:text-white text-slate-200">
                   We are on a mission to help people to fulfill their personal dreams.
                </p>
                <x-mary-button class="btn btn-primary">
                     <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.8251 15.2171H12.1748C14.0987 15.2171 15.731 13.985 16.3054 12.2764C16.3887 12.0276 16.1979 11.7713 15.9334 11.7713H14.8562C14.5133 11.7713 14.2362 11.4977 14.2362 11.16C14.2362 10.8213 14.5133 10.5467 14.8562 10.5467H15.9005C16.2463 10.5467 16.5263 10.2703 16.5263 9.92875C16.5263 9.58722 16.2463 9.31075 15.9005 9.31075H14.8562C14.5133 9.31075 14.2362 9.03619 14.2362 8.69849C14.2362 8.35984 14.5133 8.08528 14.8562 8.08528H15.9005C16.2463 8.08528 16.5263 7.8088 16.5263 7.46728C16.5263 7.12575 16.2463 6.84928 15.9005 6.84928H14.8562C14.5133 6.84928 14.2362 6.57472 14.2362 6.23606C14.2362 5.89837 14.5133 5.62381 14.8562 5.62381H15.9886C16.2483 5.62381 16.4343 5.3789 16.3645 5.13113C15.8501 3.32401 14.1694 2 12.1748 2H11.8251C9.42172 2 7.47363 3.92287 7.47363 6.29729V10.9198C7.47363 13.2933 9.42172 15.2171 11.8251 15.2171Z" fill="currentColor"></path>
                        <path opacity="0.4" d="M19.5313 9.82568C18.9966 9.82568 18.5626 10.2533 18.5626 10.7823C18.5626 14.3554 15.6186 17.2627 12.0005 17.2627C8.38136 17.2627 5.43743 14.3554 5.43743 10.7823C5.43743 10.2533 5.00345 9.82568 4.46872 9.82568C3.93398 9.82568 3.5 10.2533 3.5 10.7823C3.5 15.0873 6.79945 18.6413 11.0318 19.1186V21.0434C11.0318 21.5715 11.4648 22.0001 12.0005 22.0001C12.5352 22.0001 12.9692 21.5715 12.9692 21.0434V19.1186C17.2006 18.6413 20.5 15.0873 20.5 10.7823C20.5 10.2533 20.066 9.82568 19.5313 9.82568Z" fill="currentColor"></path>
                    </svg>
                    Announcements On Board
                </x-mary-button>
                </div>
            </div>
        </div>
    </div> --}}

        <div wire:poll.60s="refreshTable" class="p-4 border-2 border-blue-200 border-solid rounded-lg mt-14">
                <x-mary-button label="Add Loan" @click="$wire.addLoan = true"  icon="o-plus" class="bg-blue-700 dark:bg-blue-300 dark:text-black mb-3 text-white rounded-md" />
            <livewire:loans-table/>
        </div>


    {{-- adding loan drawer --}}
    <x-mary-drawer wire:model="addLoan" title="Add Loan" right>
        <div>
            <x-mary-form wire:submit="save">
                <x-mary-choices label="Available Loan Products" wire:model="loan_product_id" :options="$loanProductSearchable" single searchable class="mb-5"/>

                <x-mary-choices label="Clients" wire:model="client_id" :options="$clients" single searchable class="mb-5">
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

                    {{-- <div class="flex space-x-4 mb-5">
                        <x-mary-input label="Amount" placeholder="Loan amount" icon="o-user" hint="Enter loan amoount" wire:model="amount" />
                        <x-mary-input label="Interest Rate" placeholder="Interest rate" icon="o-user" hint="Interest" />
                    </div> --}}

                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Payment Frequency</span>
                            <span class="label-text-alt">Monthly (default)</span>
                        </div>
                        <select class="select w-full max-w-xs select-bordered" id="payment_frequency" wire:model="payment_frequency">
                            <option value="weekly" {{ (old('payment_frequency', $loan->payment_frequency ?? '') == 'weekly') ? 'selected' : '' }}>Weekly</option>
                            <option value="bi-weekly" {{ (old('payment_frequency', $loan->payment_frequency ?? '') == 'bi-weekly') ? 'selected' : '' }}>Bi-Weekly</option>
                            <option value="monthly" {{ (old('payment_frequency', $loan->payment_frequency ?? '') == 'monthly') ? 'selected' : '' }}>Monthly</option>
                        </select>
                    </label>

                <x-slot:actions>
                    {{-- Notice `onclick` is HTML --}}
                    <x-mary-button label="Cancel" @click="$wire.addLoan = false" />
                    <x-mary-button label="Confirm" class="btn-primary" type="submit" spinner="save"  />
                </x-slot:actions>
            </x-mary-form>
        </div>
    </x-mary-drawer>
    {{-- end of loan drawer --}}

</div>


