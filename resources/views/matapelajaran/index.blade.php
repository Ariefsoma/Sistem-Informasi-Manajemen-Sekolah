@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Mata Pelajaran</h2>
        <a href="{{ route('matapelajaran.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Tambah</a>
        <table class="w-full mt-4 table-auto">
            <thead><tr><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($items as $it)
                    <tr>
                        <td>{{ $it->nama ?? '—' }}</td>
                        <td>
                            <a href="{{ route('matapelajaran.edit', $it) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('matapelajaran.destroy', $it) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
</div>
@endsection
