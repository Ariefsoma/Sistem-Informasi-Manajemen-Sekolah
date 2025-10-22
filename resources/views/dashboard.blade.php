<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            SIMS — Dashboard Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    <p class="mb-4">Selamat datang, {{ Auth::user()->name }}. Ini adalah dashboard pengguna.</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-white rounded shadow">
                            <div class="text-sm text-gray-500">Total Siswa</div>
                            <div class="text-2xl font-semibold">
                                {{ class_exists(\App\Models\Siswa::class) ? \App\Models\Siswa::count() : '-' }}
                            </div>
                        </div>

                        <div class="p-4 bg-white rounded shadow">
                            <div class="text-sm text-gray-500">Pengumuman</div>
                            <div class="text-2xl font-semibold">{{ class_exists(\App\Models\Pengumuman::class) ? \App\Models\Pengumuman::count() : '-' }}</div>
                        </div>

                        <div class="p-4 bg-white rounded shadow">
                            <div class="text-sm text-gray-500">Mata Pelajaran</div>
                            <div class="text-2xl font-semibold">
                                {{ class_exists(\App\Models\MataPelajaran::class) ? \App\Models\MataPelajaran::count() : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
