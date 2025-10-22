@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold">Input Absensi - Bulk</h2>
        <p class="text-sm text-gray-600">Pilih tanggal, lalu atur status untuk setiap siswa. Setelah selesai klik Simpan.</p>

        @if(session('success'))<div class="mt-4 p-3 bg-green-100 text-green-800">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="mt-4 p-3 bg-red-100 text-red-800">{{ $errors->first() }}</div>@endif

        <form method="POST" action="{{ route('guru.absensi.storeBulk') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="border px-3 py-2 rounded" />
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($siswas as $index => $s)
                        <tr>
                            <td class="px-6 py-4">{{ $s->nama }}</td>
                            <td class="px-6 py-4">
                                <select name="attendance[{{ $index }}][status]" class="border rounded px-2 py-1">
                                    <option value="hadir">Hadir</option>
                                    <option value="ijin">Ijin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alpha">Alpha</option>
                                </select>
                                <input type="hidden" name="attendance[{{ $index }}][siswa_id]" value="{{ $s->id }}" />
                            </td>
                            <td class="px-6 py-4">
                                <input type="text" name="attendance[{{ $index }}][keterangan]" class="border px-2 py-1 rounded w-full" placeholder="(opsional)" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Absensi</button>
            </div>
        </form>
    </div>
</div>
@endsection
