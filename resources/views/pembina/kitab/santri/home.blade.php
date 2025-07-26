<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>

    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">

            <div x-data="{ pageName: `{{ $title }}` }">
                <!-- Metric Group One -->
                <div class="grid lg:grid-cols-4 gap-4 md:grid-cols-4 sm:grid-cols-4 md:gap-4">
                    <!-- Metric Item Start -->
                    @foreach ($kitabs as $kitab)
                        <a href="{{ route('pembina.santri-kitab.show', $kitab->id_kitab_santri) }}"
                            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                            <div class="flex justify-center">




                                <svg class="fill-gray-800 dark:fill-white/90" width="80" height="80"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                </svg>


                            </div>

                            <div class=" flex items-end justify-center gap-2">

                                <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">
                                    {{ $kitab->name }}
                                </h4>


                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-layout>
