@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold">Dashboard Guru</h2>
        <p class="mt-2">Selamat datang, {{ Auth::user()->name }}. Pilih tindakan:</p>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ url('/guru/nilai') }}" class="p-4 bg-blue-600 text-white rounded">Input Nilai</a>
            <a href="{{ url('/guru/absensi') }}" class="p-4 bg-green-600 text-white rounded">Input Absensi</a>
            <a href="{{ route('admin.user-links.index') }}" class="p-4 bg-gray-600 text-white rounded">Pengaturan Akun</a>
        </div>
    </div>
</div>
@endsection
