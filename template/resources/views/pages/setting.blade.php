@extends('layouts.app')

@section('page')
<form action="{{ url('/setting/update') }}" method="post">
    @csrf
    <div class="col-div-8">
        <div class="box-8">
            <div class="content-box">
                <p>
                    Profile 
                    <button type="button" style="outline: none;border: none;box-shadow: none;color: white; background-color: #f7403b;border-radius: 10px;cursor: pointer;" id="update-btn">
                        <i class="fa fa-pencil"></i> Update
                    </button>
                    <button type="submit" style="outline: none;border: none;box-shadow: none;color: white; background-color: #f7403b;border-radius: 10px;cursor: pointer;display: none;" id="save-btn">
                        <i class="fa fa-pencil"></i> Simpan
                    </button>
                </p>
                <br />
                <table>
                    <tr>
                        <th>Elevasi</th>
                        <td>
                            <div class="form-group">
                                <input type="text" name="elevasi" value="{{ $profile->elevasi }}" spellcheck="false" class="input-setting" readonly required="required"/> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Jarak Runaway</th>
                        <td>
                            <div class="form-group">
                                <input type="text" name="jarak" value="{{ $profile->jarak }}" spellcheck="false" class="input-setting" readonly required="required"/> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td>
                            <div class="form-group">
                                <input type="hidden" name="lokasi" value="{{ $profile->lokasi }}" spellcheck="false" readonly required="required"/> 
                                <input type="hidden" name="lokasi_latitude" value="{{ $profile->lokasi_latitude ?? '' }}" spellcheck="false" readonly required="required"/> 
                                <input type="hidden" name="lokasi_longitude" value="{{ $profile->lokasi_longitude ?? '' }}" spellcheck="false" readonly required="required"/> 
                                <div class="input-setting" id="show-location"><b>{{ $profile->lokasi }}<br/>{{$profile->lokasi_latitude}}&#176; S, {{$profile->lokasi_longitude}}&#176; E</b></div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div id="mapresults"></div>
                <div id="mapid"></div>
            </div>
        </div>
    </div>
    {{-- <div class="col-div-8 widget-map" id="map-setting">
        <div class="box-8">
            <div class="content-box">
                
            </div>
        </div>
    </div> --}}
</form>


<script>
let updateBtn = document.getElementById('update-btn')
let saveBtn = document.getElementById('save-btn')
let inp = document.querySelectorAll('.input-setting');
let map_el = document.getElementById('mapid')

updateBtn.addEventListener('click', function(e) {
    e.target.style.display = 'none';
    saveBtn.style.display = 'block';
    for(let i = 0; i < inp.length; i++) {
        inp[i].readOnly = false;
    }
    inp[0].focus();
})
// saveBtn.addEventListener('click', function(e) {
//     let data = {};
//     for(let i = 0; i < inp.length; i++) {
//         data[inp[i].getAttribute('name')] = inp[i].value;
//         inp[i].readOnly = true;
//     }
//     e.target.style.opacity = '0.5';
//     e.target.style.cursor = 'default';
// }, {'once': true})

</script>

@endsection