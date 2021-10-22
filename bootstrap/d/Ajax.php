<?php 
require_once('../v/DB.php');
require_once('DataPengamatan.php');

function addLeadingZero($str) {
    $dt = explode(' ', $str);
    $d = array_map(function($item) {
        return strlen($item) == 1 ? '0'.$item: $item;
    }, explode('-', $dt[0]));
    $tm = array_map(function($item) {
        return strlen($item) == 1 ? '0'.$item: $item;
    }, explode(':', $dt[1]));
    return implode('/', $d).' '.implode(':', $tm);
}
function removeLeadingZero($str) {
    $dt = explode(' ', $str);
    $d = array_map(function($item) {
        return ltrim($item, '0');
    }, explode('-', $dt[0]));
    $tm = array_map(function($item) {
        return ltrim($item, '0');
    }, explode(':', $dt[1]));
    return implode('/', $d).' '.implode(':', $tm);
}

function findIndexArray($a1, $a2) {
    // $res = -1;
    $rd = array_map(function($item) {
        $dd = date_create_from_format('d/m/Y H:i:s', addLeadingZero($item['waktu']));
        $item['waktu'] = $dd->format('Y-m-d H:i:s');
        return $item;
    },$a1);

    $na = [
        'suhu' => $a2['suhu'],
        'kelembaban' => $a2['kelembapan'],
        'Tekanan' => $a2['tekanan'],
        'Arah' => $a2['arah'],
        'Kecepatan' => $a2['kec_angin'],
        'waktu' => $a2['waktu']
    ];
    $res = array_search($na, $rd);
    return $res;
}
function findIndexArray2($a1, $a2) {
    $res = array_search($a2['waktu'], array_column($a1, 'waktu'));
    return $res;
}

function uniqueValues($a) {
    $new_arr = [];
    $pointer = 0;
    foreach($a as $rw) {
        $rw['waktu'] = str_replace('/', '-', $rw['waktu']);
        $ind = findIndexArray2($new_arr, $rw);
        if($ind === false) {
            $new_arr[$pointer] = $rw;
            $pointer++;
        } else {
            $new_arr[$pointer] = $rw;            
        }
    }
    return $new_arr;
}
$last = DataPengamatan::last();

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://139.180.220.65/get_awos/ambildata2.php");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);

$r = json_decode($output, true);

if(sizeof($last) > 0) {
    $idx = findIndexArray($r['data'], $last[0]);
    $updates = array_slice($r['data'], $idx);
    $distincts = uniqueValues($updates);
    $new_updates = array_slice($distincts, 1);
} else {
    $new_updates = $r['data'];
}

foreach($new_updates as $re) {
    
    $t = date_create_from_format('d/m/Y H:i:s', addLeadingZero($re['waktu']));
    $t = $t->format('Y-m-d H:i:s');
    
    $p = [$re['suhu'], $re['Tekanan'], $re['kelembaban'], $re['Arah'], $re['Kecepatan'], $t ? $t: null];
    
    $data = '\''.implode('\',\'', $p).'\'';

    DB::query('insert into log (suhu, tekanan, kelembapan, arah, kec_angin, waktu) values ('.$data.')')->insert();
}

curl_close($ch);     

echo json_encode(['d' => $new_updates]);