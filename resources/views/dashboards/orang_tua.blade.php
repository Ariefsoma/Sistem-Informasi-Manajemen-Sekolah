@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold">Dashboard Orang Tua</h2>
        <p class="mt-2">Halo, {{ Auth::user()->name }}. Pantau perkembangan anak Anda.</p>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('student.dashboard') }}" class="p-4 bg-blue-600 text-white rounded">Lihat Data Anak</a>
            <a href="{{ route('profile.edit') }}" class="p-4 bg-gray-600 text-white rounded">Profil</a>
        </div>
    </div>
</div>
@endsection
