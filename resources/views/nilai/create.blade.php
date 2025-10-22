@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-bold mb-4">Tambah Nilai</h2>
        <form action="{{ route('guru.nilai.index') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <select name="siswa_id" class="border p-2">
                    @foreach($siswas as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->nis }})</option>
                    @endforeach
                </select>
                <select name="mata_pelajaran_id" class="border p-2">
                    @foreach($mapels as $m)
                        <option value="{{ $m->id }}">{{ $m->nama ?? $m->id }}</option>
                    @endforeach
                </select>
                <input type="text" name="nilai" placeholder="Nilai" class="border p-2" />
                <input type="text" name="semester" placeholder="Semester" class="border p-2" />
                <input type="text" name="tahun_ajaran" placeholder="Tahun Ajaran" class="border p-2" />
            </div>
            <div class="mt-4">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
