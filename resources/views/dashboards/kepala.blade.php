@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold">Dashboard Kepala Sekolah</h2>
        <p class="mt-2">Selamat datang, {{ Auth::user()->name }}. Akses laporan dan ringkasan.</p>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('admin.dashboard') }}" class="p-4 bg-blue-600 text-white rounded">Ringkasan Sekolah</a>
            <a href="{{ route('admin.pengumuman.index') }}" class="p-4 bg-green-600 text-white rounded">Kelola Pengumuman</a>
            <a href="{{ route('profile.edit') }}" class="p-4 bg-gray-600 text-white rounded">Profil</a>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white rounded shadow">
                <div class="text-sm text-gray-500">Total Siswa</div>
                <div class="text-2xl font-semibold">{{ class_exists(\App\Models\Siswa::class) ? \App\Models\Siswa::count() : '-' }}</div>
            </div>
            <div class="p-4 bg-white rounded shadow">
                <div class="text-sm text-gray-500">Total Guru</div>
                <div class="text-2xl font-semibold">{{ class_exists(\App\Models\Guru::class) ? \App\Models\Guru::count() : '-' }}</div>
            </div>
            <div class="p-4 bg-white rounded shadow">
                <div class="text-sm text-gray-500">Total Nilai</div>
                <div class="text-2xl font-semibold">{{ class_exists(\App\Models\Nilai::class) ? \App\Models\Nilai::count() : '-' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
