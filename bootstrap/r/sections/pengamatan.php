<?php
$data = [
    'all' => DataPengamatan::getAll()
]
?>
<h3><i class="fas fa-binoculars mr-2"></i>PENGAMATAN</h3> <hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">NO</th>
            <th scope="col">SUHU</th>
            <th scope="col">ARAH ANGIN</th>
            <th scope="col">KECEPATAN ANGIN</th>
            <th scope="col">KELEMBABAN</th>
            <th scope="col">TEKANAN</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($data['all'] as $r):
        ?>
        <tr>
            <th scope="row"><?= $r['id'] ?></th>
            <td><?= $r['suhu'] ?></td>
            <td><?= $r['arah'] ?></td>
            <td><?= $r['kec_angin'] ?></td>
            <td><?= $r['kelembapan'] ?></td>
            <td><?= $r['tekanan'] ?? 0 ?></td>
            <!-- <td><a href="/action?q=hapus">Sembunyikan</a></td> -->
        </tr>
        <?php endforeach;?>
        <tr>
            <td colspan="6">
                <!-- <a href="action?q=tambah" class="btn btn-primary">Tambah</a> -->
                <a href="" class="btn btn-primary">Download</a>
            </td>
        </tr>
    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/compass@0.1.1/index.min.js"></script>