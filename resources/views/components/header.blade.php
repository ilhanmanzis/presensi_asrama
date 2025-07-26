<div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
    class="flex items-center gap-2 pt-8 sidebar-header pb-7">
    <a href="{{ url('/') }}" class="">
        <span class="logo " :class="sidebarToggle ? 'hidden' : ''">
            <div class="flex justify-start">

                <img class="dark:hidden h-12 w-14  sm:hidden md:hidden lg:block"
                    src="{{ asset('storage/logo/' . $profile['logo']) }}" alt="Logo" />
                <img class="hidden dark:block size-10 h-12 w-14 " src="{{ asset('storage/logo/' . $profile['logo']) }}"
                    alt="Logo" />
                <span class="text-lg dark:text-white font-semibold mt-3 mx-2">{{ $profile['name'] }}</span>
            </div>

        </span>

        <img class="logo-icon size-10 w-15" :class="sidebarToggle ? '' : 'hidden'"
            src="{{ asset('storage/logo/' . $profile['logo']) }}" alt="Logo" />


    </a>
</div>
