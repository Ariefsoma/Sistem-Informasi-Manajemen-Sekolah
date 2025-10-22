@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-bold mb-4">Tambah Absensi</h2>
        <form action="{{ route('guru.absensi.index') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <select name="siswa_id" class="border p-2">
                    @foreach($siswas as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->nis }})</option>
                    @endforeach
                </select>
                <input type="date" name="tanggal" class="border p-2" />
                <select name="status" class="border p-2">
                    <option value="hadir">Hadir</option>
                    <option value="ijin">Ijin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alpha">Alpha</option>
                </select>
                <input type="text" name="keterangan" placeholder="Keterangan" class="border p-2" />
            </div>
            <div class="mt-4">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
