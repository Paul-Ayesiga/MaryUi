<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/echo.js'])
    {{-- @livewireStyles --}}
    <style>
       .swal2-toast {
            background-color: #333;
            color: rgb(15, 81, 225);
            padding: 5px 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            width: 200px;
            height: 30px;
        }
    </style>
</head>
<body class="font-sans antialiased bg-base-200/50 dark:bg-base-200">
    {{-- The navbar with `sticky` and `full-width` --}}
    @livewire('nav-bar')
    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        {{-- @livewire('side-bar') --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200  mb-4 sidebar">
            <button  @click.stop="$dispatch('mary-search-open')"  class="lg:hidden relative inline-flex items-center justify-center p-0.5 mb-2 me-2 ml-5 mt-5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Spotlight Search
                </span>
            </button>
            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg" class="text-lg font-bold">
                <x-mary-menu-separator />
                <x-mary-menu-item title="Dashboard" icon="o-home" link="{{ route('dashboard') }}" route="dashboard" />
            </x-mary-menu>
            <h3 class="dark:text-orange-500 text-center font-serif mt-4">Softech</h3>
            <x-mary-menu-separator/>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Accounts" icon="o-user-circle">
                        <x-mary-menu-item title="View Accounts" icon="o-eye" link="{{ route('accounts.index')}}" route="accounts.index" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Loans" icon="o-Banknotes">
                        <x-mary-menu-item title="View Loans" icon="o-eye" link="{{ route('loans.index')}}" route="loans.index" class="text-sm" />
                        <x-mary-menu-item title="View Loan Products" icon="o-eye" class="text-sm"  link="{{ route('loans.loan_products')}}" route="loans.loan_products"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Investments" icon="o-building-library">
                        <x-mary-menu-item title="View Investment" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
            @role('client')
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Savings" icon="o-Wallet">
                        <x-mary-menu-item title="View savings" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
            @endrole
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Projects" icon="o-puzzle-piece">
                        <x-mary-menu-item title="View projects" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Campaigns" icon="o-Flag">
                        <x-mary-menu-item title="View campaigns" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Reports" icon="o-Document-text">
                        <x-mary-menu-item title="View reports" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Transactions" icon="o-Banknotes">
                        <x-mary-menu-item title="View Transactions" icon="o-eye" link="{{ route('transactions.index')}}" route="transactions.index" class="text-sm" />
                        {{-- <x-mary-menu-item title="View Loan Products" icon="o-eye" class="text-sm"  link="{{ route('loans.loan_products')}}" route="loans.loan_products"  badge="new" badge-classes="!badge-warning" /> --}}
                    </x-mary-menu-sub>
                </x-mary-menu>

            <h3 class="dark:text-orange-500 text-center font-serif mt-4">Admin</h3>
            <x-mary-menu-separator/>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Applications" icon="o-receipt-percent">
                        <x-mary-menu-item title="View applications" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Clients" icon="o-user-group">
                        <x-mary-menu-item title="View clients" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Staff" icon="o-user-group">
                        <x-mary-menu-item title="View staff" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Admin" icon="o-users">
                        <x-mary-menu-item title="View admins" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Utilities" icon="o-cpu-chip">
                        <x-mary-menu-item title="View utilities" icon="o-eye" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" class="text-sm"  badge="new" badge-classes="!badge-warning" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-item title="User Management" icon="o-user" link="" route="" class="text-sm" />
                </x-mary-menu>

            <h3 class="dark:text-orange-500 text-center font-serif mt-4">Settings</h3>
            <x-mary-menu-separator/>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Settings" icon="o-cog-8-tooth">
                        <x-mary-menu-item title="General Settings" icon="" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Email Settings"  icon="o-Envelope" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Sms Settings"  icon="o-Inbox" link="" route="" class="text-sm" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                  <span>
                    <x-mary-menu-item title="System Upgrade" icon="o-cloud-arrow-up" link="" route="" class="text-sm chat-bubble-warning" badge="U" badge-classes="!badge-danger ml-14"  />
                </x-mary-menu>

                <x-mary-menu-separator class=""/>
                <h3 class="dark:text-blue-500 mt-4 text-center font-serif">HELP</h3>

                <x-mary-menu activate-by-route active-bg-color="bg-gradient-to-r from-blue-300 to-blue-100 text-white font-bold shadow-lg"  class="font-bold text-md">
                    <x-mary-menu-sub title="Support Center" icon="o-phone">
                        <x-mary-menu-item title="About Us" icon="" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Our Team"  icon="" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="Licenses"  icon="" link="" route="" class="text-sm" />
                        <x-mary-menu-item title="FAQS"  icon="" link="" route="" class="text-sm" />
                    </x-mary-menu-sub>
                </x-mary-menu>
        </x-slot:sidebar>


        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>

    </x-mary-main>

    {{--  TOAST area --}}
    <x-mary-toast />

    {{-- <x-mary-toast/> --}}

    <x-mary-spotlight/>

    <x-support-bubble />

    @livewire('wire-elements-modal')
    @livewire('livewire-ui-spotlight')

    {{-- @livewireScripts --}}
    @livewireChartsScripts
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
