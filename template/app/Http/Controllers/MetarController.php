<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metar;

class MetarController extends Controller
{
    public function view() {
        $metars = Metar::orderBy('waktu', 'desc')->paginate(10);
        return view('pages.metar', [
            'metars' => $metars
        ]);
    }
    public function getHistory(Request $r) {
        $metars = Metar::orderBy('waktu', 'desc')->paginate(10);

        return [
            'items' => $metars->items(),
            'next_link' => $metars->nextPageUrl()
        ];
    }
}
