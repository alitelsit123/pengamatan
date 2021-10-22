<!DOCTYPE html>
<html>
    <head>
        <title>Siteawos</title>
        <link rel="icon" href="user.png" type="image/png" sizes="16x16" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" />
        {{-- <link rel="stylesheet" href="{{ asset('css/style-compass.css') }}" type="text/css" /> --}}
        <script src="https://kit.fontawesome.com/0eb6dfa52b.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/export-from-json/dist/umd/index.min.js"></script>
        @if(request()->segment(1) == '' || request()->segment(1) == 'dashboard' || request()->segment(1) == 'setting')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
        <style>
            #mapid { height: 300px; }
        </style>
        @endif
        @if(request()->segment(1) == '' || request()->segment(1) == 'dashboard') 
        <style>
            .compass {
                position: relative;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                margin: auto;
                }
                .compass > .arrow-wrapper {
                    border: 1px solid transparent;
                    position: relative;
                    width: 100%;
                    height: 100%;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(0deg);
                    transition: transform 1s ease-in-out;
                    background-size: contain;
                    border-radius: 50%;
                    z-index: 98;
                }
                .compass > .direction-wrapper {
                    border: 5px solid #ffffff;
                    position: absolute;
                    width: 115%;
                    height: 115%;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(0deg);
                    transition: transform 1s ease-in-out;
                    background-size: contain;
                    border-radius: 50%;
                    z-index: 99;
                }
                .compass > .direction-wrapper > span {
                    position: absolute;
                    color: #ffffff;
                    z-index: 100;
                    font-size: 12px;
                }
                .compass > .direction-wrapper > span.direction-0 {
                    top: 0%;
                    left: 50%;
                    transform: translateX(-60%)
                }
                .compass > .direction-wrapper > span.direction-90 {
                    top: 50%;
                    right: 0%;
                    transform: translate(-50%, -50%) rotate(90deg)
                }
                .compass > .direction-wrapper > span.direction-180 {
                    bottom: 0%;
                    left: 50%;
                    transform: translate(-55%, -20%)
                }
                .compass > .direction-wrapper > span.direction-270 {
                    top: 50%;
                    left: 0%;
                    transform: translate(0%, -55%) rotate(270deg)
                }

                .compass .arrow {
                position: absolute;
                width: 0;
                height: 0;
                top: 20px;
                left: 50%;
                transform: translate(-50%, 0%) rotate(180deg);
                border-style: solid;
                border-width: 17px 10px 0 10px;
                border-color: #f7403b transparent transparent transparent;
                z-index: 99;
                }

                .compass > .compass-circle,
                .compass > .my-point {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(90deg);
                transition: transform 0.1s ease-out;
                background: url({{ asset('images/compass-rounded-2.png') }}) center
                    no-repeat;
                background-size: contain;
                }
                .compass > .my-point {
                opacity: 0;
                width: 20%;
                height: 20%;
                background: #ffffff;
                border-radius: 50%;
                transition: opacity 0.5s ease-out;
                }
                
                .compass > .wind-speed {
                    position: absolute;
                    top: 47%;
                    left: 53%;
                    transform: translate(-50%, -50%);
                }
                .compass > .wind-speed > .num {font-weight: bold;font-size: 2rem;color: #ffffff;font-family: serif;}
                .compass > .wind-speed > .text {font-weight: bold; color: #ffffff;}
                .compass > .direction {
                    position: absolute;
                    top: 75%;
                    left: 51%;
                    transform: translate(-50%, -50%);
                    font-weight: bold;font-size: 1.5rem;color: #ffffff;font-family: serif;
                }

        </style>
        @endif
        {{-- <style>
            .widget-map{
                position: relative;
            }
            .widget-map #mapresults{
                position: absolute;
            }
            /* .widget-map #mapid{
                position: absolute;
            } */
        </style> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $.ajaxSetup({
                header: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
        </script>

    </head>

    <body>
        <div id="mySidenav" class="sidenav">
            <p class="logo"><span>٨</span>-Simoawos</p>
            <a href="{{ url('/') }}" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
            <a href="{{ url('/pengamatan') }}" class="icon-a"><i class="fa fa-binoculars icons"></i> &nbsp;&nbsp;Pengamatan</a>
            <a href="{{ url('/metar') }}" class="icon-a"><i class="fa fa-laptop-code icons"></i> &nbsp;&nbsp;Metar</a>
            <a href="{{ url('/setting') }}" class="icon-a"><i class="fa fa-cog icons"></i> &nbsp;&nbsp;Settings</a>
            <a href="{{ url('/tentang') }}" class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Tentang</a>
            <a href="{{ url('/logout') }}" class="icon-a"><i class="fa fa-sign-out-alt icons"></i> &nbsp;&nbsp;Logout</a>
        </div>
        <div id="main">
            <div class="head">
                <div class="col-div-6">
                    <span style="font-size: 30px; cursor: pointer; color: white;" class="nav">&#9776; {{ Str::title(request()->segment(1) ?? 'Dashboard') }}</span>
                    <span style="font-size: 30px; cursor: pointer; color: white;" class="nav2">&#9776; {{ Str::title(request()->segment(1)) ?? 'Dashboard' }}</span>
                </div>
                <div class="col-div-6" style="display: flex;justify-content: flex-end;">
                    <img src="{{ asset('/images/logo.PNG') }}" width="60px" height="60px">
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="clearfix"></div>
            <br />

            @yield('page')

            <div class="clearfix"></div>
        </div>

        <script>
            $(".nav").click(function () {
                $("#mySidenav").css("width", "70px");
                $("#main").css("margin-left", "70px");
                $(".logo").css("visibility", "hidden");
                $(".logo span").css("visibility", "visible");
                $(".logo span").css("margin-left", "-10px");
                $(".icon-a").css("visibility", "hidden");
                $(".icons").css("visibility", "visible");
                $(".icons").css("margin-left", "-8px");
                $(".nav").css("display", "none");
                $(".nav2").css("display", "block");
            });

            $(".nav2").click(function () {
                $("#mySidenav").css("width", "300px");
                $("#main").css("margin-left", "300px");
                $(".logo").css("visibility", "visible");
                $(".icon-a").css("visibility", "visible");
                $(".icons").css("visibility", "visible");
                $(".nav").css("display", "block");
                $(".nav2").css("display", "none");
            });
        </script>
        @if (request()->segment(1) == '' || request()->segment(1) == 'dashboard' || request()->segment(1) == 'setting')
        <script>
            var mymap = L.map('mapid').setView([{{ $profile->lokasi_latitude }}, {{ $profile->lokasi_longitude }}], 15);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWxpdGVsc2l0IiwiYSI6ImNrcjVwaDVodzAwMDIyeHFzZjA5ZjM4aXAifQ.zkAYnc7lZ4B8nW1f-TPt7Q', {
                attribution: 'gugel map',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiYWxpdGVsc2l0IiwiYSI6ImNrcjVwaDVodzAwMDIyeHFzZjA5ZjM4aXAifQ.zkAYnc7lZ4B8nW1f-TPt7Q'
            }).addTo(mymap);
            @if(request()->segment(1) == 'setting')
            var marker = L.marker([{{ $profile->lokasi_latitude }}, {{ $profile->lokasi_longitude }}]).addTo(mymap);
            marker.bindPopup(`<b>{{ $profile->lokasi }}<br/>({{$profile->lokasi_latitude}}&#176; S, {{$profile->lokasi_longitude}}&#176; E)</b>`).openPopup();
            @elseif(request()->segment(1) == '' || request()->segment(1) == 'dashboard')
            L.popup({
                closeButton: false,
                closeOnClick: false,
                autoClose: false    
            })
            .setLatLng(L.latLng([{{ $profile->lokasi_latitude }}, {{ $profile->lokasi_longitude }}]))
            .setContent(`<b>{{ $profile->lokasi }}<br/>({{$profile->lokasi_latitude}}&#176; S, {{$profile->lokasi_longitude}}&#176; E)</b>`)
            .openOn(mymap);
            @endif
            function onMapClick(e) {
                e.originalEvent.preventDefault()
                marker.bindPopup(`<b>Loading ...</b>`).openPopup();
                // if (window.location.protocol.indexOf('https') == 0){
                //     var el = document.createElement('meta')
                //     el.setAttribute('http-equiv', 'Content-Security-Policy')
                //     el.setAttribute('content', 'upgrade-insecure-requests')
                //     document.head.append(el)
                // }
                let show_lokasi = document.getElementById('show-location')
                let input_lokasi = document.querySelector('input[name=lokasi]')
                let input_lokasi_latitude = document.querySelector('input[name=lokasi_latitude]')
                let input_lokasi_longitude = document.querySelector('input[name=lokasi_longitude]')
                var options = {
                    type: 'GET',
                    url: `https://trueway-geocoding.p.rapidapi.com/ReverseGeocode?location=${e.latlng.lat}%2C${e.latlng.lng}&language=id`
                };
                // console.log(options)
                $.ajax({
                    ...options,
                    beforeSend: function(request) {
                        request.setRequestHeader('x-rapidapi-key', 'c7c219523dmsh08f16d903cd108cp1435b5jsn02bd5b13aa81')
                        request.setRequestHeader('x-rapidapi-host', 'trueway-geocoding.p.rapidapi.com')
                        show_lokasi.innerHTML = 'loading ...'
                    },
                    success: function(response) {
                        let result = response.results
                        let address = ''
                        for(let i = 0; i< result.length;i++) {
                            if(result[i] && result[i].address) {
                                address = result[i].address
                                break;
                            }
                        }
                        if(address) {
                            mymap.removeLayer(marker)
                            marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(mymap);
                            marker.bindPopup(`<b>${address}<br/>(${e.latlng.lat}&#176; S, ${e.latlng.lng}&#176; E)</b>`).openPopup();
                            input_lokasi_latitude.value = e.latlng.lat
                            input_lokasi_longitude.value = e.latlng.lng
                            input_lokasi.value = address
                            show_lokasi.innerHTML = `${address}<br/>${e.latlng.lat}&#176; S, ${e.latlng.lng}&#176; E`
                        } else {
                            alert('Gagal mendapatkan lokasi! Silahkan coba kembali')
                            input_lokasi_latitude.value = '{{ $profile->longitude }}'
                            input_lokasi_longitude.value = '{{ $profile->lokasi_longitude }}'
                            input_lokasi.value = '{{ $profile->lokasi }}'
                            show_lokasi.innerHTML = `{{ $profile->lokasi }}<br/>${e.latlng.lat}&#176; S, ${e.latlng.lng}&#176; E`
                        }
                    },
                    error: function() {
                        alert('Gagal mendapatkan lokasi! Silahkan coba kembali')
                        input_lokasi_latitude.value = '{{ $profile->longitude }}'
                        input_lokasi_longitude.value = '{{ $profile->lokasi_longitude }}'
                        input_lokasi.value = '{{ $profile->lokasi }}'
                        show_lokasi.innerHTML = `{{ $profile->lokasi }}<br/>${e.latlng.lat}&#176; S, ${e.latlng.lng}&#176; E`
                    }
                })
            }
            @if(request()->segment(1) == 'setting')
            mymap.on('click', onMapClick);
            @endif
        </script>
        @endif
    </body>
</html>
