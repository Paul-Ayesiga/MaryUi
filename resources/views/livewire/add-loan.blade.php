<div>
    <h1 class="text-4xl mb-8 font-extrabold">Loan Application Form</h1>
    <form  wire:ignore.self wire:submit.prevent="save()" method="POST">
    @csrf
    <div class="flex space-x-4">
        <x-mary-input wire:model="form.first_name"  label="First Name" icon="o-user" class="rounded-md mb-3" inline  />
        <x-mary-input wire:model="form.last_name"  label="Last Name" icon="o-user"  class="rounded-md mb-3" inline />
    </div>
    <div class="flex space-x-4">
        <x-mary-datetime wire:model="form.date_of_birth" label="Date of Birth"  icon="o-calendar" class="rounded-md mb-3" inline />
        <x-mary-input wire:model="form.national_id" label="National ID" icon="o-Identification"  class="rounded-md mb-3" inline />
    </div>
    <div class="flex space-x-4">
        <x-mary-input wire:model="form.email"  label="Email" icon="" type="email"   class="rounded-md mb-3" inline />
        <x-mary-input wire:model="form.phone_number" label="Phone Contact"  icon="o-Phone" type="tel" class="rounded-md mb-3" inline />
    </div>
    <div class="flex space-x-4">
        <x-mary-input wire:model="form.address" label="Address"  icon-right="o-map-pin" class="rounded-md mb-3"  inline />
        <x-mary-input wire:model="form.occupation" label="Occupation" icon=""  class="rounded-md mb-3" inline />
    </div>
    <div class="flex space-x-4">
        <x-mary-input wire:model="form.income_source" label="Income Source"  icon="o-Banknotes"  class="rounded-md mb-3" inline />
        <x-mary-input wire:model="form.loan_purpose" label="Loan Purpose"  icon=""  class="rounded-md mb-3" inline />
    </div>
     <div class="flex space-x-4">
        <x-mary-input wire:model="form.monthly_income" label="Monthly Income" icon="o-Banknotes" type="number" class="rounded-md mb-3" inline />
        <x-mary-input wire:model="form.loan_amount" label="Loan Amount" icon="o-Banknotes" type="number"  class="rounded-md mb-3" inline />
    </div>
    <div class="flex space-x-4">
        <x-mary-input wire:model="form.loan_term_months" label="Loan Term Months" icon="o-Banknotes" type="number"   class="rounded-md mb-3" inline />
        <x-mary-input wire:model="form.interest_rate" label="Interest Rate" icon="o-Banknotes" type="number"   class="rounded-md mb-3" inline />
    </div>
    {{-- <x-mary-select label="Loan Products" icon="o-Banknotes" :options="$loanProducts" wire:model="form.form."  class="rounded-md mb-3" inline /> --}}
    <div class="flex space-x-8 mb-5">
        <x-mary-file label="Passport Photo" wire:model="form.passport_photo" accept="">
            <img src="{{ $user->avatar ?? asset('Dicons/p.jpg') }}" class="h-40 rounded-lg" />
        </x-mary-file>
        <x-mary-file wire:model="form.form.proof_asset" label="Proof of Asset" hint="Only PDF" accept="application/pdf" class="px-15" />
    </div>
    <hr/>
    <div class="text-center mt-5">
       <x-mary-button label="Apply Now" type="submit" icon="o-plus" class="bg-blue-700 dark:bg-blue-300 dark:text-black mb-3 text-white rounded-md" />
    </div>
        {{-- @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" class="h-40 rounded-lg">
        @endif
    <input type="file" wire:model="form.photo"> --}}
</div>
