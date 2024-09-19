<div style="height: 550px; overflow:scroll;">
    <!-- HEADER -->

    <div class="breadcrumbs text-sm mb-2">
        <ul>
            <li><a>Home</a></li>
            <li><a>Dashboard</a></li>
        </ul>
    </div>

    <x-mary-nav  class="mx-3 rounded-lg shadow-lg shadow-gray-400 mb-3">
        {{-- <x-slot:middle class="!justify-end">
            <x-mary-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle> --}}
        <x-slot:actions>
            <x-mary-button label="Widget" @click="$wire.addWidget = true"  icon="o-plus" class="btn-primary rounded-none"  />
            <x-mary-button label="Chart"  @click="$wire.addChart = true"  icon="o-plus" class="btn-primary rounded-none" />
        </x-slot:actions>
    </x-mary-nav>

    <!-- TABLE  -->
        {{-- <x-mary-table :headers="$headers" :rows="$users" :sort-by="$sortBy">
            @scope('actions', $user)
            <x-mary-button icon="o-trash" wire:click="delete({{ $user['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-mary-table> --}}
         {{-- widgets --}}
        {{-- <x-mary-card>
            <div class="flex flex-wrap justify-between gap-4"  style="overflow-y:scroll;">
               <h1 class="text-5xl font-bold"> {{ $greeting }},<br>{{ Auth::user()->first_name }} {{Auth::user()->last_name}}!</h1>
            </div>
        </x-mary-card> --}}

        <x-mary-card>
            <div class="flex flex-wrap md:flex-nowrap justify-between items-center gap-4">
                <!-- Image Section -->
                <div class="w-full md:w-1/3">
                    <img src="{{asset('banners/banner3.png')}}" alt="Greeting Image" class="w-full h-auto object-cover rounded-lg">
                </div>

                <!-- Greeting Section -->
                <div class="w-full md:w-2/3">
                    <h1 class="text-6xl font-bold mt-[-95px] ml-10">
                        {{ $greeting }},
                    </h1>
                    <br>
                    <h1 class="text-4xl font-bold ml-10 text-blue-700">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!
                    </h1>
                    <p class="font-sans mt-5 ml-10">We are glad to see you again</p>
                    <p class="font-sans mt-1 ml-10">Continue where you left off</p>
                </div>
            </div>
        </x-mary-card>


        <div class="flex flex-wrap justify-between gap-4 mt-20">
            <!-- Staff Card -->
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex items-center">
                <a href="#" wire:navigate class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-full mr-3">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 12a4 4 0 014-4h4a4 4 0 014 4v4h-2v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v4H4v-4z"/>
                    </svg>
                </a>
                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Staff</h5>
                    <p class="text-gray-500 dark:text-gray-400 text-center">25</p>
                </div>
            </div>

            <!-- Clients Card -->
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex items-center">
                <a href="#" wire:navigate class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-full mr-3">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 12a4 4 0 014-4h4a4 4 0 014 4v4h-2v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v4H4v-4z"/>
                    </svg>
                </a>
                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Clients</h5>
                    <p class="text-gray-500 dark:text-gray-400 text-center">120</p>
                </div>
            </div>

            <!-- Admins Card -->
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex items-center">
                <a href="#" wire:navigate class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-full mr-3">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 12a4 4 0 014-4h4a4 4 0 014 4v4h-2v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v4H4v-4z"/>
                    </svg>
                </a>
                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Admins</h5>
                    <p class="text-gray-500 dark:text-gray-400 text-center">10</p>
                </div>
            </div>

            <!-- Loans Card -->
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex items-center">
                <a href="#" wire:navigate class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-full mr-3">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </a>
                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Loans</h5>
                    <p wire:poll.10s class="text-gray-500 dark:text-gray-400 text-center">{{ count($loans)}}</p>
                </div>
            </div>

            <!-- Loan Products Card -->
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex items-center">
                <a href="#" wire:navigate class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-full mr-3">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 12a4 4 0 014-4h4a4 4 0 014 4v4h-2v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v4H4v-4z"/>
                    </svg>
                </a>
                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Loan Products</h5>
                    <p wire:poll.10s class="text-gray-500 dark:text-gray-400 text-center">{{ count($loanProducts)}}</p>
                </div>
            </div>

            <!-- Campaigns Card -->
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex items-center">
                <a href="#" wire:navigate class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-full mr-3">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 12a4 4 0 014-4h4a4 4 0 014 4v4h-2v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v4H4v-4z"/>
                    </svg>
                </a>
                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Campaigns</h5>
                    <p class="text-gray-500 dark:text-gray-400 text-center">5</p>
                </div>
            </div>

        </div>

        {{-- end of widgets --}}

        {{--Chart Widgets  --}}
        {{-- <livewire:chart-widget> --}}


        <!-- FILTER DRAWER -->
        {{-- <x-mary-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
            <x-mary-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

            <x-slot:actions>
                <x-mary-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
                <x-mary-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            </x-slot:actions>
        </x-mary-drawer> --}}

        <x-mary-modal wire:model="addModal" title="Are you sure?">
            <div>Click "cancel" or press ESC to exit.</div>

            <x-slot:actions>
                {{-- Notice `onclick` is HTML --}}
                <x-mary-button label="Cancel" onclick="addModal.close()" />
                <x-mary-button label="Confirm" class="btn-primary" />
            </x-slot:actions>
        </x-mary-modal>
</div>
