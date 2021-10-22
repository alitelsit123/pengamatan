<?php 
require_once('./v/Info.php');
$data = DataPengamatan::last()[0];
?>
<h3><i class="fas fa-home mr-2"></i>HOME</h3>
<hr>
<h4>tggl</h4>
<div class="row text-white">
    <div class="card bg-info mt-2 ml-3" style="width: 18rem;">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fab fa-hotjar"></i>
            </div>
            <h5 class="card-title">SUHU</h5>
            <div class="display-4" id="suhu"><?= $data['suhu'] ?>C</div>
        </div>
    </div>
    <div class="card bg-success mt-2 ml-5" style="width: 18rem;">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fas fa-tint"></i>
            </div>
            <h5 class="card-title">KELEMBABAN</h5>
            <div class="display-4"  id="kelembapan"><?= $data['kelembapan'] ?>%</div>
        </div>
    </div>
    <div class="card bg-danger mt-2 ml-5" style="width: 18rem;">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fas fa-compress-alt"></i>
            </div>
            <h5 class="card-title">TEKANAN</h5>
            <div class="display-4"  id="tekanan"><?= $data['tekanan'] ?> hPa</div>
        </div>
    </div>
</div>
<div class="compass" style="margin-top: 40px;">
    <div class="arrow-wrapper">
      <div class="arrow"></div>
    </div>
    <div class="compass-circle"></div>
    <div class="my-point"></div>
    <div class="wind-speed">
        <span class="num"><?= $data['kec_angin'] ?></span>
        <span class="text">kt</span>
    </div>
    <div class="direction"><?= $data['arah']?>&#176;</div>
</div>
<!-- <button class="start-btn">Start compass</button> -->

<script>
    const compassCircle = document.querySelector(".arrow-wrapper");
    const myPoint = document.querySelector(".my-point");
    let compass;

    function init() {
        start();
    }

    function start() {
        let rotations = <?= $data['arah']?>;
        // document.getElementsByClassName('direction')[0].innerHTML = `${rotations}&#176;`;
        // document.getElementsByClassName('num')[0].innerHTML = `3.${kec}`;
        // console.log(document.getElementsByClassName('direction')[0])
        compassCircle.style.transform = 'translate(-50%, -50%) rotate('+rotations+'deg)';
        window.addEventListener("deviceorientationabsolute", handler, true);
    }

    function handler(e) {
        setInterval(() => {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let res = JSON.parse(xhttp.responseText)
                    let s = document.getElementById("suhu");
                    let k = document.getElementById("kelembapan");
                    let t = document.getElementById("tekanan");
                    if(res.d.length > 0) {
                        result = res.d[res.d.length -1]
                        s.innerHTML = result.suhu;
                        k.innerHTML = result.kelembapan;
                        t.innerHTML = result.Tekanan;
                        document.getElementsByClassName('direction')[0].innerHTML = `${result.Arah}&#176;`;
                        document.getElementsByClassName('num')[0].innerHTML = `${result.Kecepatan}`;
                        compassCircle.style.transform = 'translate(-50%, -50%) rotate('+result.Arah+'deg)';
                    }
                }
            };
            xhttp.open("GET", "<?= $info['base_url'] ?>/d/Ajax.php", true);
            xhttp.send();
        }, 5000);
    }

init();
</script>