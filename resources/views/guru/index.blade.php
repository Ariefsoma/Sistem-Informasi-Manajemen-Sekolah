@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Daftar Guru</h2>
        <a href="{{ route('guru.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Tambah Guru</a>
        <table class="w-full mt-4 table-auto">
            <thead><tr><th>NIP</th><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($gurus as $g)
                    <tr>
                        <td>{{ $g->nip }}</td>
                        <td>{{ $g->nama }}</td>
                        <td>
                            <a href="{{ route('guru.edit', $g) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('guru.destroy', $g) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $gurus->links() }}
    </div>
</div>
@endsection
