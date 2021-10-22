<?php
require_once('./v/DB.php');

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://139.180.220.65/get_awos/ambildata2.php");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);

$r = json_decode($output);


foreach($r->data as $re) {
    $dt = explode(' ', $re->waktu);
    $d = $dt[0];
    $tm = array_map(function($item) {
        return strlen($item) == 1 ? '0'.$item: $item;
    }, explode(':', $dt[1]));
    $t = date_create_from_format('d/m/Y H:i:s', $d.' '.implode(':', $tm));
    
    $p = [$re->suhu, $re->Tekanan, $re->kelembaban, $re->Arah, $re->Kecepatan, $t ? $t->format('Y-m-d H:i:s'): null];
    
    $data = '\''.implode('\',\'', $p).'\'';
    
    DB::query('insert into log (suhu, tekanan, kelembapan, arah, kec_angin, waktu) values ('.$data.')')->insert();
    // var_dump($p);
    // echo '<br>';
}

curl_close($ch);     