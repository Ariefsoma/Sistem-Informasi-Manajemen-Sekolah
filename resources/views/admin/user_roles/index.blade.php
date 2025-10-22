@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold">Manajemen Role Pengguna</h1>
    <p class="text-gray-600 mt-2">Ubah role pengguna dari sini. Hati-hati saat memberikan role <strong>admin</strong>.</p>

    <div class="mt-4">
        <form method="GET" action="{{ route('admin.user-roles.index') }}" class="mb-4">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari email atau nama" class="border rounded px-3 py-2 w-64" />
            <button class="ml-2 px-3 py-2 bg-blue-600 text-white rounded">Cari</button>
        </form>

        @if(session('success'))
            <div class="p-3 bg-green-100 text-green-800 rounded mb-3">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full">
                <thead>
                    <tr class="text-left">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $user->id }}</td>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.user-roles.update') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                                    <select name="role" class="border rounded px-2 py-1">
                                        @foreach($roles as $key => $label)
                                            <option value="{{ $key }}" @if(($user->role ?? '') === $key) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <button class="ml-2 px-3 py-1 bg-indigo-600 text-white rounded">Simpan</button>
                                </form>
                            </td>
                            <td class="px-4 py-3">
                                <!-- optional more actions here -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
