<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>

    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <!-- Breadcrumb Start -->
            <div x-data="{ pageName: `{{ $title }}` }">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                    @if (session('success'))
                        <div
                            class="rounded-xl border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15 mb-5">
                            <div class="flex items-start gap-3">
                                <div class="-mt-0.5 text-success-500">
                                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z"
                                            fill="" />
                                    </svg>
                                </div>

                                <div>
                                    <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                        {{ session('success') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
            <!-- Breadcrumb End -->

            <div class="space-y-5 sm:space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5">
                        <div class="flex items-center justify-between gap-5">
                            <a href="{{ route('admin.santri.create') }}"
                                class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 mb-5">
                                Tambah Santri
                            </a>
                            <form action="{{ route('admin.santri') }}" method="get">
                                <div class="flex justify-between mb-2">

                                    <div class="relative">
                                        <span class="absolute top-1/2 left-4 -translate-y-1/2">
                                            <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z"
                                                    fill="" />
                                            </svg>
                                        </span>
                                        <input type="text" placeholder="cari nama atau nis..." id="search-input"
                                            name="santri" value="{{ request('santri') }}"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-12 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[400px] dark:border-gray-800 dark:bg-gray-900 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30" />

                                        <button id="search-button"
                                            class="absolute top-1/2 right-2.5 inline-flex -translate-y-1/2 items-center gap-0.5 rounded-lg border border-gray-200 bg-gray-50 px-[7px] py-[4.5px] text-xs -tracking-[0.2px] text-gray-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-400">
                                            <span> Search </span>

                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>

                        <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                            <!-- ====== Table Six Start -->
                            <div
                                class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                <div class="max-w-full overflow-x-auto">
                                    <table class="min-w-full">
                                        <!-- table header start -->
                                        <thead>
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            No
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            NIS
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Nama
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Kelas
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Asrama
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Status
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Aksi
                                                        </p>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <!-- table header end -->

                                        @php
                                            $i = 1;
                                        @endphp
                                        <!-- table body start -->
                                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                            @foreach ($santris as $santri)
                                                <tr>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <div class="flex items-center gap-3">
                                                                <span
                                                                    class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                                    {{ $i++ }}
                                                                </span>


                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <div class="flex -space-x-2">
                                                                <p
                                                                    class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    {{ $santri['nis'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <div class="flex -space-x-2">
                                                                <p
                                                                    class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    {{ $santri['name'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <div class="flex -space-x-2">
                                                                <p
                                                                    class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    {{ $santri->asrama->name ?? 'Tidak ada' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <div class="flex -space-x-2">
                                                                <p
                                                                    class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    {{ $santri->kelas->name ?? 'Tidak ada' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <div class="flex -space-x-2">
                                                                <p
                                                                    class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    {{ $santri->status ?? 'Tidak ada' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="px-5 py-4 sm:px-6">

                                                        <div class="flex items-center">

                                                            <form
                                                                action="{{ route('admin.santri.delete', ['id' => $santri['id_santri']]) }}"
                                                                onsubmit="return confirm('Apakah anda yakin ingin menghapus data?')"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')

                                                                <button type="submit"
                                                                    class="inline-flex items-center gap-2 rounded-lg bg-error-500 px-2 py-1.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-error-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="size-6">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                    </svg>


                                                                </button>
                                                            </form>

                                                            <a href="{{ route('admin.santri.show', ['id' => $santri['id_santri']]) }}"
                                                                class="inline-flex items-center gap-2 rounded-lg bg-success-500 px-2 py-1.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-success-600 mx-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>

                                                            </a>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            <!-- table body end -->

                                        </tbody>
                                    </table>
                                    <!-- Pagination links -->
                                    <div class="border-t border-gray-100 dark:border-gray-800 p-4">
                                        {{ $santris->links() }}
                                    </div>
                                </div>
                            </div>

                            <!-- ====== Table Six End -->
                        </div>
                    </div>
                </div>
            </div>
    </main>
</x-layout>
