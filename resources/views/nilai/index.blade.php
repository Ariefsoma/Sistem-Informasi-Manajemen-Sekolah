@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Nilai</h2>
        <a href="{{ route('guru.nilai.index') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Kembali</a>
        <a href="{{ route('guru.nilai.index') }}/create" class="px-3 py-2 bg-green-600 text-white rounded ml-2">Tambah Nilai</a>
        <table class="w-full mt-4 table-auto">
            <thead><tr><th>Siswa</th><th>Mapel</th><th>Nilai</th><th>Semester</th><th>Tahun</th></tr></thead>
            <tbody>
                @foreach($nilais ?? [] as $n)
                    <tr>
                        <td>{{ $n->siswa->nama ?? '-' }}</td>
                        <td>{{ $n->mataPelajaran->nama ?? '-' }}</td>
                        <td>{{ $n->nilai }}</td>
                        <td>{{ $n->semester }}</td>
                        <td>{{ $n->tahun_ajaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ ($nilais ?? collect())->links() }}
    </div>
</div>
@endsection
