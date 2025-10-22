@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold">{{ $siswa->nama }}</h2>
                <div class="text-sm text-gray-600">NIS: {{ $siswa->nis ?? '-' }}</div>
            </div>
            <div class="text-right text-sm text-gray-500">Dashboard Siswa</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-3">Nilai</h3>
                <div class="overflow-x-auto bg-white rounded">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mapel</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($nilais as $n)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $n->mataPelajaran->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium">{{ $n->nilai }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $n->semester }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada nilai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Absensi</h3>
                <div class="overflow-x-auto bg-white rounded">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($absensis as $a)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($a->tanggal)
                                            {{ \Illuminate\Support\Carbon::parse($a->tanggal)->format('Y-m-d') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($a->status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $a->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data absensi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
