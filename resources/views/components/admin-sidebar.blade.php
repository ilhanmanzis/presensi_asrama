<nav x-data="{ selected: $persist('{{ $selected }}') }">
    <!-- Menu Group -->
    <div :class="sidebarToggle ? '' : ''">
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
            <x-side-link href="{{ route('admin.dashboard') }}" label="Dashboard" selected={{ $selected }}
                icon='<path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z" fill="" />'>
            </x-side-link>

            {{-- data master --}}
            <li>
                <a href="#" @click.prevent="selected = (selected === 'Master Data' ? '':'Master Data')"
                    class="menu-item group"
                    :class="(selected === 'Master Data') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-active' :
                    'menu-item-inactive'">
                    <svg :class="(selected === 'Master Data') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-icon-active' : 'menu-item-icon-inactive'"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
                        <path
                            d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
                        <path
                            d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
                        <path
                            d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />




                    </svg>

                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Master Data
                    </span>

                    <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                        :class="[(selected === 'Master Data') ? 'menu-item-arrow-active' :
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
                    :class="(selected === 'Master Data') ? 'block' : 'hidden'">
                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                        class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                        <x-drop-side-link href="{{ route('admin.santri') }}" page="Santri">
                            Santri
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('admin.santriwati') }}" page="Santriwati">
                            Santriwati
                        </x-drop-side-link>

                        <x-drop-side-link href="{{ route('admin.asrama') }}" page="Asrama">
                            Asrama
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('admin.kelas') }}" page="Kelas">
                            Kelas
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('admin.ekstrakurikuler') }}" page="Ekstrakurikuler">
                            Ekstrakurikuler
                        </x-drop-side-link>
                    </ul>
                </div>
                <!-- Dropdown Menu End -->
            </li>

            {{-- kitab --}}
            <li>
                <a href="#"
                    @click.prevent="selected = (selected === 'Kelompok Sorogan Kitab' ? '':'Kelompok Sorogan Kitab')"
                    class="menu-item group"
                    :class="(selected === 'Kelompok Sorogan Kitab') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-active' :
                    'menu-item-inactive'">
                    <svg :class="(selected === 'Kelompok Sorogan Kitab') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-icon-active' : 'menu-item-icon-inactive'"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />




                    </svg>

                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Kelompok Kitab
                    </span>

                    <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                        :class="[(selected === 'Kelompok Sorogan Kitab') ? 'menu-item-arrow-active' :
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
                    :class="(selected === 'Kelompok Sorogan Kitab') ? 'block' : 'hidden'">
                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                        class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                        <x-drop-side-link href="{{ route('admin.santri-kitab') }}" page="Kitab Santri">
                            Santri
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('admin.santriwati-kitab') }}" page="Kitab Santriwati">
                            Santriwati
                        </x-drop-side-link>
                    </ul>
                </div>
                <!-- Dropdown Menu End -->
            </li>
            {{-- alquran --}}
            <li>
                <a href="#"
                    @click.prevent="selected = (selected === 'Kelompok Sorogan Alquran' ? '':'Kelompok Sorogan Alquran')"
                    class="menu-item group"
                    :class="(selected === 'Kelompok Sorogan Alquran') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-active' :
                    'menu-item-inactive'">
                    <svg :class="(selected === 'Kelompok Sorogan Alquran') || (page === 'device' || page === 'formLayout') ?
                    'menu-item-icon-active' : 'menu-item-icon-inactive'"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />




                    </svg>

                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Kelompok Al-Quran
                    </span>

                    <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                        :class="[(selected === 'Kelompok Sorogan Alquran') ? 'menu-item-arrow-active' :
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
                    :class="(selected === 'Kelompok Sorogan Alquran') ? 'block' : 'hidden'">
                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                        class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                        <x-drop-side-link href="{{ route('admin.santri-alquran') }}" page="Alquran Santri">
                            Santri
                        </x-drop-side-link>
                        <x-drop-side-link href="{{ route('admin.santriwati-alquran') }}" page="Alquran Santriwati">
                            Santriwati
                        </x-drop-side-link>
                    </ul>
                </div>
                <!-- Dropdown Menu End -->
            </li>




            <x-side-link href="{{ route('admin.users') }}" label="Manajemen User" selected={{ $selected }}
                icon='<path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />'>
            </x-side-link>
            <x-side-link href="{{ route('laporan') }}" label="Export & Laporan" selected={{ $selected }}
                icon='  <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 0 0 3 3h.27l-.155 1.705A1.875 1.875 0 0 0 7.232 22.5h9.536a1.875 1.875 0 0 0 1.867-2.045l-.155-1.705h.27a3 3 0 0 0 3-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0 0 18 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM16.5 6.205v-2.83A.375.375 0 0 0 16.125 3h-8.25a.375.375 0 0 0-.375.375v2.83a49.353 49.353 0 0 1 9 0Zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 0 1-.374.409H7.232a.375.375 0 0 1-.374-.409l.526-5.784a.373.373 0 0 1 .333-.337 41.741 41.741 0 0 1 8.566 0Zm.967-3.97a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H18a.75.75 0 0 1-.75-.75V10.5ZM15 9.75a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V10.5a.75.75 0 0 0-.75-.75H15Z" clip-rule="evenodd" />'>
            </x-side-link>
            <x-side-link href="{{ route('admin.import') }}" label="Import Excel" selected={{ $selected }}
                icon='<path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />'>
            </x-side-link>
            <x-side-link href="{{ route('admin.setting') }}" label="Setting" selected={{ $selected }}
                icon='<path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />'>
            </x-side-link>








        </ul>
    </div>


</nav>
