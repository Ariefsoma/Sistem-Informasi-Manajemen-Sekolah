@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold">Mapping User ↔ Profiles</h2>
        <p class="text-sm text-gray-600">Gunakan halaman ini untuk mengaitkan akun user ke data Guru atau Siswa.</p>

        @if(session('success'))<div class="mt-4 p-3 bg-green-100 text-green-800">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="mt-4 p-3 bg-red-100 text-red-800">{{ $errors->first() }}</div>@endif

        <div class="mt-4">
            <form method="GET" class="mb-4">
                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari user email atau nama" class="border p-2 w-1/2" />
                <button class="px-3 py-2 bg-gray-700 text-white rounded ms-2">Cari</button>
            </form>

            <form method="POST" class="mb-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <select name="user_id" class="border p-2">
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->id }} - {{ $u->email }} ({{ $u->role }})</option>
                        @endforeach
                    </select>

                    <select name="map_type" class="border p-2">
                        <option value="guru">Map ke Guru</option>
                        <option value="siswa">Map ke Siswa</option>
                        <option value="parent">Map sebagai Orang Tua</option>
                    </select>

                    <select name="profile_id" class="border p-2">
                        <optgroup label="Guru">
                            @foreach($gurus as $g)
                                <option value="{{ $g->id }}">G: {{ $g->nama }} ({{ $g->nip }})</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Siswa">
                            @foreach($siswas as $s)
                                <option value="{{ $s->id }}">S: {{ $s->nama }} ({{ $s->nis }})</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="mt-4">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Mapping</button>
                </div>
            </form>

            <hr class="my-6" />
            <h3 class="text-lg font-semibold mb-2">Buat Orang Tua dan Map ke Siswa</h3>
            <form method="POST" action="{{ route('admin.user-links.create-parent') }}" class="mb-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <select name="siswa_id" class="border p-2">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswas as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->nis }})</option>
                        @endforeach
                    </select>

                    <input type="text" name="name" placeholder="Nama Orang Tua" class="border p-2" />

                    <input type="email" name="email" placeholder="Email Orang Tua" class="border p-2" />
                </div>
                <div class="mt-4">
                    <button class="px-4 py-2 bg-green-600 text-white rounded">Buat & Map Orang Tua</button>
                </div>
            </form>

            <h3 class="text-lg font-semibold mb-2 mt-6">Map Orang Tua yang Sudah Ada ke Siswa</h3>
            <form method="POST" class="mb-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <select name="user_id" class="border p-2">
                        <option value="">-- Pilih Orang Tua (User) --</option>
                        @foreach($parents as $p)
                            <option value="{{ $p->id }}">{{ $p->name }} &lt;{{ $p->email }}&gt;</option>
                        @endforeach
                    </select>

                    <input type="hidden" name="map_type" value="parent" />

                    <select name="profile_id" class="border p-2">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswas as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->nis }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <button class="px-4 py-2 bg-yellow-600 text-white rounded">Map Orang Tua yang Ada</button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead><tr><th>ID</th><th>Email</th><th>Role</th><th>Guru</th><th>Siswa</th><th>Parent</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr class="border-t">
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->role }}</td>
                                <td>{{ \App\Models\Guru::where('user_id',$u->id)->value('nama') ?? '-' }}</td>
                                <td>{{ \App\Models\Siswa::where('user_id',$u->id)->value('nama') ?? '-' }}</td>
                                <td>{{ \App\Models\Siswa::where('parent_user_id',$u->id)->value('nama') ?? '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.user-links.unmap') }}" onsubmit="return confirm('Hapus mapping untuk user ini?')">
                                        @csrf
                                        <input type="hidden" name="type" value="guru" />
                                        <input type="hidden" name="id" value="{{ \App\Models\Guru::where('user_id',$u->id)->value('id') ?? '' }}" />
                                        <button class="text-sm text-red-600">Unmap Guru</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $users->links() }}</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // optional: add more client-side validation
    document.addEventListener('DOMContentLoaded', function(){
        // no-op for now
    });
</script>
@endpush
