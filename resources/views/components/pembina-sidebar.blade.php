<nav x-data="{ selected: $persist('{{ $selected }}') }">
    <!-- Menu Group -->
    <div>
        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
            <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                MENU
            </span>

            <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="mx-auto fill-current menu-group-icon"
                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                    fill="" />
            </svg>
        </h3>

        <ul class="flex flex-col gap-4 mb-6">
            <x-side-link href="{{ route('pembina.dashboard') }}" label="Dashboard" selected={{ $selected }}
                icon='<path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z" fill="" />'>
            </x-side-link>

            {{-- jamaah --}}
            <li>
                <a href="#" @click.prevent="selected = (selected === 'Jamaah' ? '':'Jamaah')"
                    class="menu-item group"
                    :class="(selected === 'Jamaah') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-active' :
                    'menu-item-inactive'">
                    <svg :class="(selected === 'Jamaah') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-icon-active' : 'menu-item-icon-inactive'"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />

                    </svg>

                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Jamaah
                    </span>

                    <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                        :class="[(selected === 'Jamaah') ? 'menu-item-arrow-active' :
                            'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                        ]"
                        width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <!-- Dropdown Menu Start -->
                <div class="overflow-hidden transform translate"
                    :class="(selected === 'Jamaah') ? 'block' : 'hidden'">
                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                        class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                        <x-drop-side-link href="{{ route('pembina.santri-jamaah') }}" page="Jamaah Santri">
                            Santri
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('pembina.santriwati-jamaah') }}" page="Jamaah Santriwati">
                            Santriwati
                        </x-drop-side-link>
                    </ul>
                </div>
                <!-- Dropdown Menu End -->
            </li>

            {{-- bandongan --}}
            <li>
                <a href="#" @click.prevent="selected = (selected === 'Bandongan' ? '':'Bandongan')"
                    class="menu-item group"
                    :class="(selected === 'Bandongan') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-active' :
                    'menu-item-inactive'">
                    <svg :class="(selected === 'Bandongan') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-icon-active' : 'menu-item-icon-inactive'"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />


                    </svg>



                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Kegiatan Bandongan
                    </span>

                    <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                        :class="[(selected === 'Bandongan') ? 'menu-item-arrow-active' :
                            'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                        ]"
                        width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <!-- Dropdown Menu Start -->
                <div class="overflow-hidden transform translate"
                    :class="(selected === 'Bandongan') ? 'block' : 'hidden'">
                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                        class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                        <x-drop-side-link href="{{ route('pembina.santri-bandongan') }}" page="Bandongan Santri">
                            Santri
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('pembina.santriwati-bandongan') }}"
                            page="Bandongan Santriwati">
                            Santriwati
                        </x-drop-side-link>
                    </ul>
                </div>
                <!-- Dropdown Menu End -->
            </li>

            {{-- kitab --}}
            <li>
                <a href="#" @click.prevent="selected = (selected === 'Kitab' ? '':'Kitab')"
                    class="menu-item group"
                    :class="(selected === 'Kitab') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-active' :
                    'menu-item-inactive'">
                    <svg :class="(selected === 'Kitab') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-icon-active' : 'menu-item-icon-inactive'"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />


                    </svg>



                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Sorogan Kitab
                    </span>

                    <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                        :class="[(selected === 'Kitab') ? 'menu-item-arrow-active' :
                            'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                        ]"
                        width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <!-- Dropdown Menu Start -->
                <div class="overflow-hidden transform translate"
                    :class="(selected === 'Kitab') ? 'block' : 'hidden'">
                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                        class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                        <x-drop-side-link href="{{ route('pembina.santri-kitab') }}" page="Kitab Santri">
                            Santri
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('pembina.santriwati-kitab') }}" page="Kitab Santriwati">
                            Santriwati
                        </x-drop-side-link>
                    </ul>
                </div>
                <!-- Dropdown Menu End -->
            </li>

            {{-- Alquran --}}
            <li>
                <a href="#" @click.prevent="selected = (selected === 'Alquran' ? '':'Alquran')"
                    class="menu-item group"
                    :class="(selected === 'Alquran') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-active' :
                    'menu-item-inactive'">
                    <svg :class="(selected === 'Alquran') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-icon-active' : 'menu-item-icon-inactive'"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />


                    </svg>



                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Sorogan Alquran
                    </span>

                    <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                        :class="[(selected === 'Alquran') ? 'menu-item-arrow-active' :
                            'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                        ]"
                        width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <!-- Dropdown Menu Start -->
                <div class="overflow-hidden transform translate"
                    :class="(selected === 'Alquran') ? 'block' : 'hidden'">
                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                        class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                        <x-drop-side-link href="{{ route('pembina.santri-alquran') }}" page="Alquran Santri">
                            Santri
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('pembina.santriwati-alquran') }}" page="Alquran Santriwati">
                            Santriwati
                        </x-drop-side-link>
                    </ul>
                </div>
                <!-- Dropdown Menu End -->
            </li>
            <x-side-link href="{{ route('pembina.ekstrakurikuler') }}" label="Ekstrakurikuler"
                selected={{ $selected }}
                icon='<path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />'>
            </x-side-link>



        </ul>
    </div>


</nav>
