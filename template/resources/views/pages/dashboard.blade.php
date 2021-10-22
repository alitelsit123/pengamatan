@extends('layouts.app')

@section('page')
<div class="col-div-3">
    <div class="box">
        <p style="max-width: 70%!important;">
            <font size="3" id="waktu">
                {{-- {{ $pengamatan->waktu }} --}}-
            </font><br />
            <span>Date & Time</span>
        </p>
        <i class="fas fa-calendar-week box-icon"></i>
    </div>
</div>
<div class="col-div-3">
    <div class="box">
        <p id="suhu">
            {{-- {{ $pengamatan->suhu }}<sup>o</sup>C<br />
            <span>Suhu</span> --}}-
        </p>
        <i class="fa fa-temperature-low box-icon"></i>
    </div>
</div>
<div class="col-div-3">
    <div class="box">
        <p id="kelembapan">
            {{-- {{ $pengamatan->kelembapan }}%<br /> --}}-
            <span>Kelembaban</span>
        </p>
        <i class="fa fa-tint box-icon"></i>
    </div>
</div>
<div class="col-div-3">
    <div class="box">
        <p id="tekanan">
            {{-- {{ $pengamatan->tekanan }} hPa<br /> --}}-
            <span>Tekanan</span>
        </p>
        <i class="fa fa-compress-alt box-icon"></i>
    </div>
</div>
<div class="clearfix"></div>
<br />
<br />
<div class="col-div-8">
    <div class="box-8">
        <div class="content-box">
            <p>Profile</p>
            <br />
            <table>
                <tr>
                    <th>Lokasi</th>
                    <td id="lokasi">
                        {{-- {{ $profile->lokasi }} --}}-
                    </td>
                </tr>
                <tr>
                    <th>Elevasi</th>
                    <td id="elevasi">
                        {{-- {{ $profile->elevasi }}m --}}-
                    </td>
                </tr>
                <tr>
                    <th>Suhu (K)</th>
                    <td id="suhukelvin">
                        {{-- {{ (double)$pengamatan->suhu + 273 }} K --}}-
                    </td>
                </tr>
                <tr>
                    <th>QFE</th>
                    <td id="qfe">
                    {{-- {{
                        number_format((double)$pengamatan->tekanan * ( 1 + ( ((double)$profile->jarak*9.81) / (287 * ((double)$pengamatan->suhu + 273)) ) ), 1)    
                    }} --}}-
                    </td>
                </tr>
                <tr>
                    <th>QNH</th>
                    <td id="qnh">-</td>
                </tr>
                <tr>
                    <th>Dew Point</th>
                    <td id="dew_point">-</td>
                </tr>
                <tr>
                    <th>Metar</th>
                    <td id="metar">-</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="col-div-4">
    <div class="box-4">
        <div class="content-box">
            <p>Arah & Kecepatan Angin</p>
        </div>
        <div class="compass" style="margin-top: 10px;">
            <div class="direction-wrapper">
                <span class="direction-0">0</span>
                <span class="direction-90">90</span>
                <span class="direction-180">180</span>
                <span class="direction-270">270</span>
            </div>
            <div class="arrow-wrapper">
              <div class="arrow"></div>
            </div>
            <div class="compass-circle"></div>
            <div class="my-point"></div>
            <div class="wind-speed">
                <span class="num">
                    -
                    {{-- {{ $pengamatan->kec_angin }} --}}
                </span>
                <span class="text">kt</span>
            </div>
            <div class="direction">
                -
                {{-- {{ $pengamatan->arah }}&#176; --}}
            </div>
        </div>
    </div>
</div>

<div class="col-div-8 widget-map">
    <div class="box-8">
        <div id="mapresults"></div>
        <div id="mapid"></div>
    </div>
</div>

<script>
const compassCircle = document.querySelector(".arrow-wrapper");
const myPoint = document.querySelector(".my-point");
let compass;
let initTime = '{{ $pengamatan->waktu }}';

function init() {
    start();
}

function start() {
    let rotations = {{ $pengamatan->arah }};
    compassCircle.style.transform = 'translate(-50%, -50%) rotate('+rotations+'deg)';
    handler();
}

function handler() {
    // let intrv = setInterval(() => {
        // var xhttp = new XMLHttpRequest();
        // function responses() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         let res = JSON.parse(xhttp.responseText)
        //         let s = document.getElementById("suhu");
        //         let k = document.getElementById("kelembapan");
        //         let t = document.getElementById("tekanan");
        //         if(res.d.length > 0) {
        //             result = res.d[res.d.length -1]
        //             s.innerHTML = result.suhu;
        //             k.innerHTML = result.kelembapan;
        //             t.innerHTML = result.Tekanan;
        //             document.getElementsByClassName('direction')[0].innerHTML = `${result.Arah}&#176;`;
        //             document.getElementsByClassName('num')[0].innerHTML = `${result.Kecepatan}`;
        //             compassCircle.style.transform = 'translate(-50%, -50%) rotate('+result.Arah+'deg)';
        //         }
        //         console.log(res)
        //     }
        // };
        // xhttp.open("POST", "{{ url('/updates') }}", true);
        // xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        // xhttp.send();
        
    // }, 5000);
    $.ajax({
        url: '{{ url("/updates") }}',
        type: 'post',
        data: {
            '_token': '{{ csrf_token() }}'
        },
        success: function(res) {
            let w = document.getElementById("waktu");
            let s = document.getElementById("suhu");
            let k = document.getElementById("kelembapan");
            let t = document.getElementById("tekanan");
            
            let lokasi = document.getElementById('lokasi');
            let elevasi = document.getElementById('elevasi');
            let suhukelvin = document.getElementById('suhukelvin');
            let qfe = document.getElementById('qfe');
            let qnh = document.getElementById('qnh');
            let dew_point = document.getElementById('dew_point');
            let metar = document.getElementById('metar');
            // console.log(res.d)
            if(res.d) {
                result = res.d
                w.innerHTML = `${ result.waktu }`;
                s.innerHTML = `${ result.suhu }<sup>o</sup>C<br /><span>Suhu</span>`;
                k.innerHTML = `${ result.kelembapan }%<br /><span>Kelembaban</span>`;
                t.innerHTML = `${ result.tekanan } hPa<br /><span>Tekanan</span>`;
                document.getElementsByClassName('direction')[0].innerHTML = `${result.arah}&#176;`;
                document.getElementsByClassName('num')[0].innerHTML = `${result.kec_angin}`;
                compassCircle.style.transform = 'translate(-50%, -50%) rotate('+result.arah+'deg)';

                lokasi.innerHTML = `${res.p.lokasi}<br/>${res.p.lokasi_latitude}&#176; S, ${res.p.lokasi_longitude}&#176; E`;
                elevasi.innerHTML = `${res.p.elevasi}m`;
                suhukelvin.innerHTML = `${result.suhu + 273} K`;
                
                let qfe_calc = result.tekanan * ( 1+( ({{(double)$profile->jarak}}*9.81) / (287 * (result.suhu + 273)) ) );
                qfe.innerHTML = `${Number(qfe_calc).toFixed(1)} hPa`;
                
                qnh_sup = (res.p.elevasi*9.81)/(287*(288.15+((-0.0065*res.p.elevasi)/2)));
                qnh_calc = qfe_calc*(Math.pow(2.72, qnh_sup));
                qnh.innerHTML = `${Number(qnh_calc).toFixed(1)} hPa`;

                dew_calc = result.suhu-((100-result.kelembapan)/5);
                dew_point.innerHTML = `${Number(dew_calc).toFixed(2)}&#176;C`;

                metar_time = new Date(result.waktu_epoch*1000);
                metar_time.setHours(metar_time.getHours() - 7);
                metar_time_result = `${metar_time.getDate()}${metar_time.getUTCHours() <= 9 ? '0': ''}${metar_time.getUTCHours()}${metar_time.getUTCMinutes() <= 9 ? '0': ''}${metar_time.getUTCMinutes()}z`;
                metar_arah_result = `${Math.floor(result.arah)}${Math.floor(result.kec_angin)}KT`;
                metar_temp_result = `${Math.floor(result.suhu)}/${Math.floor(dew_calc)}`;
                metar_qnh_result = `Q${Math.floor(qnh_calc)}`;
                metar_result = `METAR ID ${metar_time_result} ${metar_arah_result} //// //// //// ${metar_temp_result} ${metar_qnh_result}`;
                metar.innerHTML = `${metar_result}`;

                $.ajax({
                    url: "{{ url('/metar_updates') }}",
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        m: metar_result,
                        w: result.waktu,
                    },
                    success: function(response) {}
                })

            }
            if(initTime != res.d.waktu) {
                initTime = res.d.waktu
            }
        }
    })
    setTimeout(handler, 8000)
}

setTimeout(init, 500);
</script>
@endsection