@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Absensi</h2>
        <a href="{{ route('guru.absensi.index') }}/create" class="px-3 py-2 bg-green-600 text-white rounded">Tambah Absensi</a>
        <table class="w-full mt-4 table-auto">
            <thead><tr><th>Tanggal</th><th>Siswa</th><th>Status</th><th>Keterangan</th></tr></thead>
            <tbody>
                @foreach($absensis ?? [] as $a)
                    <tr>
                        <td>{{ $a->tanggal->format('Y-m-d') }}</td>
                        <td>{{ $a->siswa->nama ?? '-' }}</td>
                        <td>{{ $a->status }}</td>
                        <td>{{ $a->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ ($absensis ?? collect())->links() }}
    </div>
</div>
@endsection
