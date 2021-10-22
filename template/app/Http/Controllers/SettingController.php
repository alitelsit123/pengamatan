<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class SettingController extends Controller
{
    public function view() {
        $profile = Profile::first();
        return view('pages.setting', ['profile' => $profile]);
    }
    public function update(Request $r) {
        $r->validate([
            'lokasi' => ['required'],
            'lokasi_latitude' => ['required'],
            'lokasi_longitude' => ['required'],
            'elevasi' => ['required'],
            'jarak' => ['required'],
        ]);
        $input = $r->all();
        $profile = Profile::first();
        $profile->lokasi = $r['lokasi'];
        $profile->lokasi_latitude = $r['lokasi_latitude'];
        $profile->lokasi_longitude = $r['lokasi_longitude'];
        $profile->elevasi = $r['elevasi'];
        $profile->jarak = $r['jarak'];
        $profile->save();
        return redirect()->back();
    }
}
