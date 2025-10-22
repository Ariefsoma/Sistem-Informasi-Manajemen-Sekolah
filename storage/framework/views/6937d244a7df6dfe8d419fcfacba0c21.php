

<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 py-20 text-center">
        <h1 class="text-4xl font-bold">SIMS</h1>
        <p class="mt-4 text-lg text-gray-600">Sistem Informasi Manajemen Sekolah — kelola siswa, guru, jadwal, nilai, dan administrasi dengan mudah.</p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="<?php echo e(route('register')); ?>" class="px-6 py-2 bg-blue-600 text-white rounded">Daftar</a>
            <a href="<?php echo e(route('login')); ?>" class="px-6 py-2 border border-gray-300 rounded">Masuk</a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-semibold">Fitur Utama</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="p-6 bg-white rounded shadow">
                <h3 class="font-semibold">Modul Akademik</h3>
                <p class="text-sm text-gray-500 mt-2">Data siswa, guru, kelas, nilai, absensi, jadwal ujian.</p>
            </div>
            <div class="p-6 bg-white rounded shadow">
                <h3 class="font-semibold">Modul Administrasi</h3>
                <p class="text-sm text-gray-500 mt-2">Keuangan, inventaris, surat, dan arsip.</p>
            </div>
            <div class="p-6 bg-white rounded shadow">
                <h3 class="font-semibold">Modul Komunikasi</h3>
                <p class="text-sm text-gray-500 mt-2">Pengumuman, pesan, notifikasi tugas/nilai.</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\SIMS\resources\views/landing.blade.php ENDPATH**/ ?>