<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class PengamatanController extends Controller
{
    public function view() {
        $pengamatan = Log::orderBy('waktu', 'desc')->paginate(10);
        return view('pages.pengamatan', [
            'pengamatan' => $pengamatan
        ]);
    }
    public function getHistory() {
        $pengamatan = Log::orderBy('waktu', 'desc')->paginate(10);

        return [
            'items' => $pengamatan->items(),
            'next_link' => $pengamatan->nextPageUrl()
        ];
    }
}
