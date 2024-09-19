{{-- resources/views/livewire/transaction-page.blade.php --}}
<div>
    <!-- Transaction Form -->
    <x-mary-card class="p-6">
        <x-slot name="header">
            <h2 class="text-xl font-bold">Transaction Form</h2>
        </x-slot>

        <!-- Success Message -->
        @if (session()->has('message'))
            <x-mary-alert type="success" :message="session('message')" />
        @endif

        <form wire:submit.prevent="makeTransaction">
            <div class="mb-5">
                <!-- Amount Input -->
                <x-mary-input
                    label="Amount"
                    type="number"
                    min=100
                    wire:model.defer="amount"
                    placeholder="Enter amount"
                />
            </div><br>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" >
                 <x-mary-choices label="Sender" wire:model="from_account_id" :options="$client_accounts" single searchable class="mb-5">
                        @scope('item', $account)
                            <x-mary-list-item :item="$account" sub-value="account_number">
                                <x-slot:avatar>
                                    <x-mary-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full" />
                                </x-slot:avatar>
                                <p>{{$account->account_number}}</p>
                                <x-slot:actions>
                                    <x-mary-badge :value="$account->account_type" />
                                </x-slot:actions>
                            </x-mary-list-item>
                        @endscope

                        @scope('selection', $account)
                            {{ $account->account_number }} ({{ $account->account_type }})
                        @endscope
                </x-mary-choices>

                   <x-mary-choices label="Receiver" wire:model="to_account_id" :options="$client_accounts" single searchable class="mb-5">
                        @scope('item', $account)
                            <x-mary-list-item :item="$account" sub-value="account_number">
                                <x-slot:avatar>
                                    <x-mary-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full" />
                                </x-slot:avatar>
                                <p>{{$account->account_number}}</p>
                                <x-slot:actions>
                                    <x-mary-badge :value="$account->account_type" />
                                </x-slot:actions>
                            </x-mary-list-item>
                        @endscope

                        @scope('selection', $account)
                            {{ $account->account_number }} ({{ $account->account_type }})
                        @endscope
                </x-mary-choices>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <x-mary-button type="submit" label="Submit Transaction"  spinner="makeTransaction"/>
            </div>
        </form>
    </x-mary-card>
</div>
