<x-layout>
    <x-slot name="selected">{{ $selected }}</x-slot>
    <x-slot name="page">{{ $page }}</x-slot>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="p-8">

        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `{{ $title }}` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 mx-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
            </div>

        </div>
        <!-- Breadcrumb End -->
        <div class=" mx-5 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">


            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Anggota Kelompok Sorogan Al-Quran
                </h3>
            </div>
            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <div x-data="anggotaApp()">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white/90 mb-8">Kelompok: {{ $kelompok->name }}
                    </h2>


                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Tambah Anggota
                        </label>
                        <div class="flex gap-2">
                            <input type="text" x-model="keyword"
                                class="dark:bg-dark-900 shadow-theme-xs focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 sm:w-full md:w-2/3 lg:w-1/2 rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300 focus:border-brand-300 dark:border-gray-700"
                                placeholder="Cari nama atau NIS..." />
                            <button @click="cariSantriwati" class="bg-blue-500 text-white px-3 py-2 rounded">
                                Cari
                            </button>
                        </div>
                    </div>


                    <div class="my-4">
                        <!-- Hasil pencarian -->
                        <template x-if="hasilPencarian.length > 0">
                            <table class="w-full">
                                <!-- table header start -->
                                <thead>
                                    <tr class="border-y border-gray-100 dark:border-gray-800 text-left">
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">NIS
                                            </p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama
                                            </p>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi
                                            </p>
                                        </th>
                                    </tr>
                                </thead>

                                <!-- table body with x-for -->
                                <tbody>
                                    <template x-for="santriwati in hasilPencarian" :key="santriwati.id_santriwati">
                                        <tr>
                                            <td class="px-5 py-4 sm:px-6">
                                                <span x-text="santriwati.nis"
                                                    class="block font-medium text-gray-800 text-theme-sm dark:text-white/90"></span>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <span x-text="santriwati.name"
                                                    class="block font-medium text-gray-800 text-theme-sm dark:text-white/90"></span>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <button @click="tambah(santriwati)"
                                                    :disabled="sudahAda(santriwati.id_santriwati)"
                                                    :class="sudahAda(santriwati.id_santriwati) ?
                                                        'bg-gray-400 cursor-not-allowed' :
                                                        'bg-green-500 hover:bg-green-600 cursor-pointer'"
                                                    class="text-white px-2 py-1 rounded text-sm transition">
                                                    Tambah
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </template>
                        <!-- Tampilkan pesan jika hasil kosong -->
                        <template x-if="hasilPencarian.length === 0">
                            <p class="text-sm text-gray-500 mt-3">Tidak ada hasil pencarian</p>
                        </template>

                    </div>

                    <h2 class="border-t pt-2 text-xl font-bold text-gray-800 dark:text-white/90 mb-8">Anggota Kelompok
                    </h2>

                    <template x-if="anggota.length > 0">
                        <table class="w-full">
                            <!-- table header start -->
                            <thead>
                                <tr class="border-y border-gray-100 dark:border-gray-800 text-left">
                                    <th class="px-5 py-3 sm:px-6">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">NIS
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi
                                        </p>
                                    </th>
                                </tr>
                            </thead>

                            <!-- table body with x-for -->
                            <tbody>
                                <template x-for="(a, i) in anggota" :key="a.id">
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <span x-text="a.nis"
                                                class="block font-medium text-gray-800 text-theme-sm dark:text-white/90"></span>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <span x-text="a.name"
                                                class="block font-medium text-gray-800 text-theme-sm dark:text-white/90"></span>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <button
                                                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm transition"
                                                @click="hapus(i)">Hapus</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </template>
                    <!-- Tampilkan pesan jika hasil kosong -->
                    <template x-if="anggota.length === 0">
                        <p class="text-sm text-gray-500 mt-3">Tidak ada anggota</p>
                    </template>


                    <form method="POST"
                        :action="'{{ route('admin.santriwati-alquran.simpan', $kelompok->id_alquran_santriwati) }}'">
                        @csrf
                        <template x-for="a in anggota" :key="a.id">
                            <input type="hidden" name="anggota[]" :value="a.id">
                        </template>
                        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                    </form>
                </div>

                <script>
                    function anggotaApp() {
                        return {
                            keyword: '',
                            hasilPencarian: [],
                            anggota: @json($anggota),

                            cariSantriwati() {
                                fetch(`/admin/cari-santriwati?q=${this.keyword}`)
                                    .then(res => res.json())
                                    .then(data => {
                                        this.hasilPencarian = data;
                                    });
                            },
                            tambah(santriwati) {
                                if (!this.sudahAda(santriwati.id_santriwati)) {
                                    this.anggota.push({
                                        id: santriwati.id_santriwati,
                                        name: santriwati.name,
                                        nis: santriwati.nis
                                    });
                                }
                            },
                            hapus(index) {
                                this.anggota.splice(index, 1);
                            },
                            sudahAda(id) {
                                return this.anggota.some(a => a.id == id);
                            }
                        }
                    }
                </script>



            </div>
        </div>




    </div>
</x-layout>
