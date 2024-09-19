<div>
    <x-mary-nav sticky full-width class="mx-3 rounded-lg shadow-lg">

        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            {{-- Brand --}}
            <div><img src="{{asset('logos/logo.png')}}" alt="" width="150" height="100" class="my-[-50px] hidden sm:flex"></div>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            {{-- <x-mary-input  placeholder="Search Softech" icon="o-magnifying-glass" class="w-90 h-8 border-b-pink-950"/> --}}

            {{-- search bar --}}
            <form class="hidden sm:flex md:flex items-center max-w-sm mx-auto">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                        </svg>
                    </div>
                    <input wire:focus="spotlight" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" press ⌘ + k to search" required />
                </div>
                <button wire:click="spotlight" type="button" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
            {{-- search bar --}}

            {{-- go pro --}}
            <x-mary-popover>
                <x-slot:trigger>
                    <a class="hidden sm:flex flex-row items-center gap-2 mx-2  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 ">
                        <svg class="icon-16" width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.4274 2.5783C20.9274 2.0673 20.1874 1.8783 19.4974 2.0783L3.40742 6.7273C2.67942 6.9293 2.16342 7.5063 2.02442 8.2383C1.88242 8.9843 2.37842 9.9323 3.02642 10.3283L8.05742 13.4003C8.57342 13.7163 9.23942 13.6373 9.66642 13.2093L15.4274 7.4483C15.7174 7.1473 16.1974 7.1473 16.4874 7.4483C16.7774 7.7373 16.7774 8.2083 16.4874 8.5083L10.7164 14.2693C10.2884 14.6973 10.2084 15.3613 10.5234 15.8783L13.5974 20.9283C13.9574 21.5273 14.5774 21.8683 15.2574 21.8683C15.3374 21.8683 15.4274 21.8683 15.5074 21.8573C16.2874 21.7583 16.9074 21.2273 17.1374 20.4773L21.9074 4.5083C22.1174 3.8283 21.9274 3.0883 21.4274 2.5783Z" fill="currentColor"></path>
                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M3.01049 16.8079C2.81849 16.8079 2.62649 16.7349 2.48049 16.5879C2.18749 16.2949 2.18749 15.8209 2.48049 15.5279L3.84549 14.1619C4.13849 13.8699 4.61349 13.8699 4.90649 14.1619C5.19849 14.4549 5.19849 14.9299 4.90649 15.2229L3.54049 16.5879C3.39449 16.7349 3.20249 16.8079 3.01049 16.8079ZM6.77169 18.0003C6.57969 18.0003 6.38769 17.9273 6.24169 17.7803C5.94869 17.4873 5.94869 17.0133 6.24169 16.7203L7.60669 15.3543C7.89969 15.0623 8.37469 15.0623 8.66769 15.3543C8.95969 15.6473 8.95969 16.1223 8.66769 16.4153L7.30169 17.7803C7.15569 17.9273 6.96369 18.0003 6.77169 18.0003ZM7.02539 21.5683C7.17139 21.7153 7.36339 21.7883 7.55539 21.7883C7.74739 21.7883 7.93939 21.7153 8.08539 21.5683L9.45139 20.2033C9.74339 19.9103 9.74339 19.4353 9.45139 19.1423C9.15839 18.8503 8.68339 18.8503 8.39039 19.1423L7.02539 20.5083C6.73239 20.8013 6.73239 21.2753 7.02539 21.5683Z" fill="currentColor"></path>
                        </svg> Go Pro
                    </a>
                </x-slot:trigger>
                <x-slot:content>
                    <small>Have a touch at our Advanced Services <br> by subscribing to Pro
                        <x-mary-badge value="Go!" class="badge-warning" />
                    </small>
                </x-slot:content>
            </x-mary-popover>
            {{-- end of go pro --}}

            {{-- language dropdown --}}
            <x-mary-dropdown class="shadow-md z-10">
                <x-slot:trigger>
                    <button type="button" data-dropdown-toggle="language-dropdown-menu" class="hidden sm:flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:text-white">
                        <svg class="w-5 h-5 rounded-full me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 3900 3900"><path fill="#b22234" d="M0 0h7410v3900H0z"/><path d="M0 450h7410m0 600H0m0 600h7410m0 600H0m0 600h7410m0 600H0" stroke="#fff" stroke-width="300"/><path fill="#3c3b6e" d="M0 0h2964v2100H0z"/><g fill="#fff"><g id="d"><g id="c"><g id="e"><g id="b"><path id="a" d="M247 90l70.534 217.082-184.66-134.164h228.253L176.466 307.082z"/><use xlink:href="#a" y="420"/><use xlink:href="#a" y="840"/><use xlink:href="#a" y="1260"/></g><use xlink:href="#a" y="1680"/></g><use xlink:href="#b" x="247" y="210"/></g><use xlink:href="#c" x="494"/></g><use xlink:href="#d" x="988"/><use xlink:href="#c" x="1976"/><use xlink:href="#e" x="2470"/></g></svg>
                         English (US)
                    </button>
                </x-slot:trigger>

                <x-mary-menu-item title="English" />
                <x-mary-menu-item title="French" />
                <x-mary-menu-item title="Spanish" />
                <x-mary-menu-item title="German" />

            </x-mary-dropdown>
            {{-- end of language dropdown --}}

            {{-- messages --}}
             <x-mary-button icon="o-envelope" class="btn-ghost btn-sm relative"  wire:click="$toggle('messages')" responsive>
                <x-mary-badge value="20" class="badge-info absolute -right-1 -top-1 text-white px-1" />
            </x-mary-button>
             <!-- messages DRAWER -->
            <x-mary-drawer wire:model="messages" title="Messages" right separator with-close-button class="lg:w-1/3">
                <x-mary-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.messages = false" />

                <x-slot:actions>
                    <x-mary-button label="Done" icon="o-check" class="btn-primary" @click="$wire.messages = false" />
                    <x-mary-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
                </x-slot:actions>
            </x-mary-drawer>
            {{-- end of messages --}}

            {{-- notifications --}}
            <x-mary-button icon="o-bell" class="btn-ghost btn-sm relative"  wire:click="$toggle('notifications')" responsive>
                <x-mary-badge  :value="count($notificationList)"   wire:poll.keep-alive class="badge-error absolute -right-1 -top-1 text-white px-1" />
            </x-mary-button>
             <!-- Notifications DRAWER -->
            <x-mary-drawer wire:model="notifications" title="Notifications" right separator with-close-button class="lg:w-1/3 bg-white shadow-lg">
                <x-mary-input placeholder="Search..." wire:model.live="search" icon="o-magnifying-glass" @keydown.enter="$wire.messages = false" />
                <div class="space-y-4">
                    @php
                        $user = auth()->user();
                    @endphp
                    <x-mary-button icon="o-trash" class="bg-blue-700 rounded-md mt-5 text-white" wire:click="clearAll">
                        delete all notifications
                    </x-mary-button>
                    <x-mary-loading class="loading-dots ml-20" wire:loading/>
                    @forelse($user->unreadNotifications as $notification)
                        <div wire:key="{{$notification->id}}"  wire:loading.remove wire:target="deleteNotification('{{ $notification->id }}')" class="flex items-start p-4 border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <div class="flex-1">
                                {{-- Display notification message --}}
                                <span class="text-xs text-gray-500 mr-2">
                                <p> {{ $notification->data['message']['name']}}</p>
                                <p> {{ $notification->data['message']['description']}}</p>
                                </span>
                            </div>
                            <div>
                                <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        {{-- {{ $notification->created_at->format('M d, Y') }} --}}
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div>

                                <x-mary-button
                                    icon="o-trash"
                                    class="btn-xs btn-ghost border-collapse"
                                    wire:click="deleteNotification('{{ $notification->id }}')"
                                />
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">
                            No new notifications.
                        </div>
                    @endforelse
                </div>
                {{-- <x-slot:actions>
                    <x-mary-button label="Done" icon="o-check" class="btn-primary w-full mt-4" @click="$wire.notifications = false" />
                    <x-mary-button label="Reset" icon="o-x-mark" wire:click="clear" spinner class="w-full mt-2" />
                </x-slot:actions> --}}
            </x-mary-drawer>

            {{-- end of notifications --}}

            <x-mary-theme-toggle darkTheme="dark" lightTheme="retro" />
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar online">
                    <div class="w-10 rounded-full">
                    <img
                        alt="User_photo"
                        src="{{asset('Dicons/p1.jpg')}}" />
                    </div>
                </div>
                <ul
                    tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                     @if($user = auth()->user())
                        <x-mary-list-item :item="$user" value="first_name" sub-value="email" no-separator no-hover class="pt-2">
                            <x-slot:actions>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"/>
                            </x-slot:actions>
                        </x-mary-list-item>
                        <x-mary-menu-separator />
                    @endif
                    <li>
                    <a class="justify-between">
                        Profile
                        <span class="badge">New</span>
                    </a>
                    </li>
                    <li><a>Settings</a></li>
                </ul>
            </div>
        </x-slot:actions>
    </x-mary-nav>
</div>
