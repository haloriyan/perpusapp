@extends('layouts.admin')

@section('title', "Jam Buka Perpustakaan")

@section('head.dependencies')
<style>
    .isCovid {
        display: inline-block;
        margin-top: 10px;
        border-radius: 900px;
        background-color: #ddd;
        padding: 10px 25px;
        cursor: pointer;
    }
    .isCovid.active {
        background-color: #2ecc71;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        @if ($message != "")
            <div class="bg-hijau-transparan rounded p-2 mb-2">
                {{ $message }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Buka</th>
                    <th>Tutup</th>
                    <th>Masa Covid ?</th>
                    <th class="lebar-15"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $item)
                    <tr>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->is_covid == 1 ? $item->waktu_buka_covid : $item->waktu_buka }}</td>
                        <td>{{ $item->is_covid == 1 ? $item->waktu_tutup_covid : $item->waktu_tutup }}</td>
                        <td>{{ $item->is_covid == 1 ? "Ya" : "Tidak" }}</td>
                        <td>
                            <span class="bg-biru-transparan p-1 pl-2 pr-2 rounded pointer" onclick="edit('{{ $item }}')">
                                <i class="fas fa-edit"></i>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="editJadwal">
    <div class="popup">
        <h3 class="border-bottom m-0 p-2">Edit Jadwal Hari <span id="day"></span>
            <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editJadwal')"></i>
        </h3>
        <div class="wrap">
            <form action="{{ route('admin.jadwal.update') }}" method="POST">
                <input type="hidden" name="id" id="id">
                {{ csrf_field() }}
                <div class="bagi bagi-2">
                    <div>Jam Buka :</div>
                    <input type="text" class="box" name="waktu_buka" id="waktu_buka">
                </div>
                <div class="bagi bagi-2">
                    <div>Jam Buka ketika Covid :</div>
                    <input type="text" class="box" name="waktu_buka_covid" id="waktu_buka_covid">
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-3">Jam Tutup :</div>
                    <input type="text" class="box" name="waktu_tutup" id="waktu_tutup">
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-3">Jam Tutup ketika Covid :</div>
                    <input type="text" class="box" name="waktu_tutup_covid" id="waktu_tutup_covid">
                </div>

                <div class="mt-2">Berlakukan jam covid ?</div>
                <div class="isCovid" onclick="toggleIsCovid(this)" value="1">Ya</div>
                <div class="isCovid" onclick="toggleIsCovid(this)" value="0">Tidak</div>

                <input type="hidden" name="is_covid" id="is_covid">

                <button class="lebar-100 mt-3 hijau">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    let state = {
        isCovid: 1
    }
    const edit = data => {
        data = JSON.parse(data);
        munculPopup('#editJadwal');
        
        select("#editJadwal #id").value = data.id;
        select("#editJadwal #day").innerText = data.hari;
        select("#editJadwal #waktu_buka").value = data.waktu_buka;
        select("#editJadwal #waktu_buka_covid").value = data.waktu_buka_covid;
        select("#editJadwal #waktu_tutup").value = data.waktu_tutup;
        select("#editJadwal #waktu_tutup_covid").value = data.waktu_tutup_covid;
        select("#editJadwal #is_covid").value = data.is_covid;
        select(`#editJadwal .isCovid[value='${data.is_covid}']`).classList.add('active');
    }

    const toggleIsCovid = target => {
        selectAll('.isCovid').forEach(btn => btn.classList.remove('active'));
        let val = target.getAttribute('value');
        select("#editJadwal #is_covid").value = val;
        select(`#editJadwal .isCovid[value='${val}']`).classList.add('active');
    }
</script>
@endsection