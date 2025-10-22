@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Daftar Siswa</h2>
        <a href="{{ route('siswa.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Tambah Siswa</a>
        <table class="w-full mt-4 table-auto">
            <thead><tr><th>NIS</th><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($siswas as $s)
                    <tr>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>
                            <a href="{{ route('siswa.edit', $s) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('siswa.destroy', $s) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $siswas->links() }}
    </div>
</div>
@endsection
