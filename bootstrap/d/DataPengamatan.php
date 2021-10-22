<?php
class DataPengamatan {
    static function getAll() {
        return DB::query('select * from log')->result();
    }
    static function last() {
        return DB::query('select * from log order by waktu desc limit 1')->result();
    }
    static function tambahPengamatan($data) {
        $data = implode(',', array_map(function($item) {
            return $item;
        }, $data));
        return DB::query('insert into log (suhu, tekanan, kelembapan, arah, kec_angin) values ($data)')->insert();
    }
}
?>