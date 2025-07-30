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
                            <a href="{{ route('pembina.santriwati-bandongan.create') }}"
                                class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 mb-5">
                                Tambah Data
                            </a>
                            <form action="{{ route('pembina.santriwati-bandongan') }}" method="get">
                                <div class="flex justify-between mb-2">

                                    <div>
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Tanggal
                                        </label>

                                        <div class="relative">
                                            <input type="date" placeholder="Select date"
                                                value="{{ request('tanggal') }}" name="tanggal"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-8 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                                onclick="this.showPicker()" />
                                            <span
                                                class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                <svg class="fill-current" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                        fill="" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>



                                    <button type="submit "
                                        class="inline-flex items-center  px-2 py-1 text-xs font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 ml-2 mt-5">
                                        Search
                                    </button>
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
                                                            Tanggal
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Kegiatan
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Jumlah Santriwati
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
                                            @foreach ($bandongans as $bandongan)
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
                                                                    {{ $bandongan['tanggal'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <div class="flex -space-x-2">
                                                                <p
                                                                    class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    {{ $bandongan['kegiatan'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <div class="flex items-center">
                                                            <div class="flex -space-x-2">
                                                                <p
                                                                    class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    {{ $bandongan->presensi->where('status', 'hadir')->count() }}
                                                                    hadir
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="px-5 py-4 sm:px-6">

                                                        <div class="flex items-center">



                                                            <a href="{{ route('pembina.santriwati-bandongan.show', ['id' => $bandongan['id_bandongan_santriwati']]) }}"
                                                                class="inline-flex items-center gap-2 rounded-lg bg-success-500 px-2 py-1.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-success-600 mx-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>

                                                            </a>
                                                            <a href="{{ route('pembina.santriwati-bandongan.detail', ['id' => $bandongan['id_bandongan_santriwati']]) }}"
                                                                class="inline-flex items-center gap-2 rounded-lg bg-blue-500 px-2 py-1.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-blue-600 mx-3">
                                                                Lihat Detail

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
                                        {{ $bandongans->links() }}
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
