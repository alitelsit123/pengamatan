<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'suhu', 'waktu', 'arah', 'tekanan', 'kec_angin', 'kelembapan'
    ];
    protected $appends = ['waktu_epoch'];

    public function getWaktuEpochAttribute() {
        return date_create_from_format('Y-m-d H:i:s', $this->waktu)->getTimestamp();
    }
    public function getArahAttribute($value) {
        return \number_format($value, 2);
    }
    // public function getWaktuAttribute($value) {
    //     $d = date_create_from_format('Y-m-d H:i:s', $value);
    //     $date = ltrim($d->format('d'), '0').'/'.ltrim($d->format('m'), '0').'/'.ltrim($d->format('Y'), '0');
    //     $h = ltrim($d->format('H'), '0');
    //     $m = ltrim($d->format('m'), '0');
    //     $s = ltrim($d->format('s'), '0');
    //     $time = (\strlen($h) == 0 ? '0': $h) .':'. (\strlen($m) == 0 ? '0': $m) .':'. (\strlen($s) == 0 ? '0': $s);
    //     return $date.' '.$time;
    // }
}
