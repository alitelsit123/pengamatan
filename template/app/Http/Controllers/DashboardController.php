<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Log;
use App\Models\Profile;
use App\Models\Metar;

class DashboardController extends Controller
{
    public function view(Request $r) {
        $data = [
            'profile' => Profile::first(),
            'pengamatan' => Log::orderBy('waktu', 'desc')->first()
        ];
        return view('pages.dashboard', $data);
    }

    public function updates(Request $r) {
        $response = Http::get('http://139.180.220.65/get_awos/ambildata2.php');
        $dirty = $response->json();
        $dirtyArray = collect($dirty['data']);
        $lastData = Log::orderBy('waktu', 'desc')->first();
        $dataToInsert = $dirtyArray->map(function($item) {
            $dt = explode(' ', $item['waktu']);
            $d = array_map(function($item) {
                return strlen($item) == 1 ? '0'.$item: $item;
            }, explode('/', $dt[0]));
            $tm = array_map(function($item) {
                return strlen($item) == 1 ? '0'.$item: $item;
            }, explode(':', $dt[1]));
            $rest = date_create_from_format('d-m-Y H:i:s', implode('-', $d).' '.implode(':', $tm));
            $item['waktu'] = $rest->format('Y-m-d H:i:s');
            $iterate = [
                'suhu' => $item['suhu'],
                'waktu' => $item['waktu'],
                'tekanan' => $item['Tekanan'],
                'kelembapan' => $item['kelembaban'],
                'arah' => $item['Arah'],
                'kec_angin' => $item['Kecepatan'],
            ];
            return $iterate;
        });
        $filteredResult = $dataToInsert->where('waktu', '>=', $lastData->waktu);
        $finalInserts = $filteredResult->toArray();
        foreach($finalInserts as $r):
            Log::updateOrCreate([
                'waktu' => $r['waktu']
            ], [
                'suhu' => $r['suhu'], 
                'tekanan' => $r['tekanan'], 
                'kelembapan' => $r['kelembapan'], 
                'arah' => $r['arah'], 
                'kec_angin' => $r['kec_angin']
            ]);
        endforeach;
        $lastUpdated = Log::orderBy('waktu', 'desc')->first();
        $profile = Profile::first();
        return [
            'd' => $lastUpdated,
            'p' => $profile,
            'new_updates' => $filteredResult,
            'waktudb' => $lastData,
            'waktuapi' => $dirtyArray->first(),
            't' => '25/4/2021 15:10:10' > '24/4/2021 15:5:5',
            'all' => Log::all()
        ];
    }
    public function metarUpdates(Request $r) {
        $payload = $r->all();
        $metar = Metar::firstOrCreate(['kode' => $payload['m'], 'waktu' => $payload['w']]);
        // Metar::query()->delete();
        // $d = \json_decode($payload['m_all'], true);
        // foreach($d as $r) {
        //     $metar = Metar::create(['kode' => $r['m'], 'waktu' => $r['w']]);
        // }
        return ['m' => $metar];
    }

    public function get_all(Request $request) {
        $type = $request->only(['type']);
        $data = [];
        if($type['type'] == 'pengamatan') {
            $data = Log::orderBy('waktu', 'desc')->get(); 
        } else if($type['type'] == 'metar') {
            $data = Metar::orderBy('waktu', 'desc')->get();
        } else {
            $data = [];
        }
        return $data;
    }
}
