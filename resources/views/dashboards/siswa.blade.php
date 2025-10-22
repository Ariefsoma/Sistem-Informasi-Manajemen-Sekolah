@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold">Dashboard Siswa</h2>
        <p class="mt-2">Halo, {{ Auth::user()->name }}. Akses data akademikmu di bawah ini.</p>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('student.dashboard') }}" class="p-4 bg-blue-600 text-white rounded">Lihat Nilai & Absensi</a>
            <a href="{{ route('profile.edit') }}" class="p-4 bg-gray-600 text-white rounded">Profil</a>
        </div>
        <div class="mt-6">
            <div class="p-4 bg-white rounded shadow">
                <div class="text-sm text-gray-500">Info</div>
                <div class="text-lg">Gunakan "Lihat Nilai & Absensi" untuk melihat ringkasan akademik Anda.</div>
            </div>
        </div>
    </div>
</div>
@endsection
