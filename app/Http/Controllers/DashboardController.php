<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user->role ?? null;

        switch ($role) {
            case 'admin':
                // admin view is located at resources/views/admin/dashboard.blade.php
                return view('admin.dashboard');
            case 'guru':
                return view('dashboards.guru');
            case 'siswa':
                return view('dashboards.siswa');
            case 'orang_tua':
                return view('dashboards.orang_tua');
            case 'kepala':
                return view('dashboards.kepala');
            default:
                return view('dashboard');
        }
    }
}
