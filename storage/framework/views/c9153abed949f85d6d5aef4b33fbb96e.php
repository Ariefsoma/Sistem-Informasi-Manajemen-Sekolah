

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold">SIMS — Sistem Informasi Manajemen Sekolah</h1>
    <p class="text-gray-600 mt-2">Selamat datang di panel administrasi. Berikut ringkasan singkat data sekolah.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="p-4 bg-white rounded shadow">
            <div class="text-sm text-gray-500">Total Siswa</div>
            <div class="text-2xl font-semibold">
                <?php echo e(class_exists(\App\Models\Siswa::class) ? \App\Models\Siswa::count() : '-'); ?>

            </div>
        </div>

        <div class="p-4 bg-white rounded shadow">
            <div class="text-sm text-gray-500">Total Guru</div>
            <div class="text-2xl font-semibold">
                <?php echo e(class_exists(\App\Models\Guru::class) ? \App\Models\Guru::count() : '-'); ?>

            </div>
        </div>

        <div class="p-4 bg-white rounded shadow">
            <div class="text-sm text-gray-500">Mata Pelajaran</div>
            <div class="text-2xl font-semibold">
                <?php echo e(class_exists(\App\Models\MataPelajaran::class) ? \App\Models\MataPelajaran::count() : '-'); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\SIMS\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>