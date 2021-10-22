@extends('layouts.app')

@section('page')
<div class="col-div-12">
    <div class="box-8">
        <div class="content-box">
            <p>Histori Pengamatan
                <button type="button" style="outline: none;border: none;box-shadow: none;color: white; background-color: #f7403b;border-radius: 10px;cursor: pointer;" 
                id="download-btn">
                    <i class="fa fa-download"></i> Download All
                </button>
            </p>
            <br />
            <table>
                <tr>
                    <th>Waktu</th>
                    <th>Suhu</th>
                    <th>Kelembaban</th>
                    <th>Tekanan</th>
                    <th>Arah</th>
                    <th>Kecepatan</th>
                </tr>
                @forelse ($pengamatan as $rw)
                    <tr>
                        <td>{{ $rw->waktu }}</td>
                        <td>{{ $rw->suhu }}</td>
                        <td>{{ $rw->kelembapan }}</td>
                        <td>{{ $rw->tekanan }}</td>
                        <td>{{ $rw->arah }}</td>
                        <td>{{ $rw->kec_angin }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Data tidak tersedia</td>
                    </tr>
                @endforelse
                @if(sizeof($pengamatan) > 0)
                <tr>
                    <td colspan="6">
                        {{ $pengamatan->links('vendor.pagination.default') }}
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>
</div>
<script>
    let downloadBtn = document.getElementById('download-btn');
    downloadBtn.addEventListener('click', function(e) {
        downloadBtn.innerHTML = '<i class="fa fa-download"></i> Downloading ...';
        $.ajax({
            url: '{{ url("/get_exports") }}',
            type: 'post',
            data: {
                '_token': '{{ csrf_token() }}',
                'type': 'pengamatan'
            },
            success: function(result) {
                const date = new Date()
                const data = result
                result.map(function(item) {
                    delete item.waktu_epoch;
                    delete item.id;
                    return item;
                })
                const fileName = `pengamatan_${date.getFullYear()}_${date.getMonth() <= 9 ? '0': ''}${date.getMonth()}_${date.getDate() <= 9 ? '0': ''}${date.getDate()}`
                const exportType = 'csv'
                window.exportFromJSON({ data, fileName, exportType })
                // console.log(result);
            },
            complete: function() {
                downloadBtn.innerHTML = '<i class="fa fa-download"></i> Download All';
            }
        })
    })
</script>
@endsection