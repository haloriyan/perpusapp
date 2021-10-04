@extends('layouts.admin')

@section('title', "Data Buku")

@section('head.dependencies')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('header.action')
<button class="biru" onclick="munculPopup('#addBuku')">
    <i class="fas fa-plus mr-1"></i> Buku Baru
</button>
@endsection

@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        @if ($message != "")
            <div class="bg-hijau-transparan rounded p-2 mb-2">
                {{ $message }}
            </div>
        @endif

        <div class="bagi lebar-40"></div>
        <div class="bagi lebar-60">
            <form>
                <div class="mt-2">Cari buku :</div>
                <input type="text" class="box" name="judul" placeholder="Cari berdasarkan judul">
            </form>
        </div>

        <div class="overflowAuto">
            <table class="teks-kecil mt-2">
                <thead>
                    <tr>
                        <th>No. Klasifikasi</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Subyek</th>
                        <th>Deskripsi Fisik</th>
                        <th>Lokasi</th>
                        <th class="lebar-10"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                        <tr>
                            <td>{{ $buku->no_klasifikasi }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>{{ $buku->subyek }}</td>
                            <td>{{ $buku->deskripsi_fisik }}</td>
                            <td>{{ $buku->lokasi }}</td>
                            <td class="teks-normal">
                                <span class="mr-1 teks-hijau pointer" onclick="edit('{{ $buku }}')">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <a href="{{ route('admin.buku.delete', $buku->id) }}" class="teks-merah" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="rata-tengah mt-3">
                {{ $bukus->links() }}
            </div>
        </div>
    </div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="addBuku">
    <div class="popup" style="width: 80%">
        <div class="wrap">
            <h3 class="m-0">Tambah Buku Baru
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addBuku')"></i>
            </h3>
            <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data" class="wrap super mt-0">
                {{ csrf_field() }}
                <div class="mt-2">No. Klasifikasi :</div>
                <input type="text" class="box" name="no_klasifikasi" id="no_klasifikasi" required>
                <div class="mt-2">Judul :</div>
                <input type="text" class="box" name="judul" id="judul" required>
                <div class="mt-2">Penulis :</div>
                <input type="text" class="box" name="penulis" id="penulis" required>
                <div class="bagi bagi-2">
                    <div class="mt-2">Penerbit :</div>
                    <input type="text" class="box" name="penerbit" id="penerbit" required>
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-2">Tahun Terbit :</div>
                    <input type="text" class="box" name="tahun_terbit" id="tahun_terbit" required>
                </div>
                <div class="mt-2">Subyek :</div>
                <input type="text" class="box" name="subyek" id="subyek" required>
                <div class="mt-2">Deskripsi Fisik :</div>
                <input type="text" class="box" name="deskripsi_fisik" id="deskripsi_fisik">
                <div class="mt-2">Lokasi :</div>
                <input type="text" class="box" name="lokasi" id="lokasi" required>

                <button class="biru mt-3 lebar-100">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editBuku">
    <div class="popup" style="width: 80%">
        <div class="wrap">
            <h3 class="m-0">Edit Buku
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editBuku')"></i>
            </h3>
            <form action="{{ route('admin.buku.update') }}" method="POST" enctype="multipart/form-data" class="wrap super mt-0">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="mt-2">No. Klasifikasi :</div>
                <input type="text" class="box" name="no_klasifikasi" id="no_klasifikasi" required>
                <div class="mt-2">Judul :</div>
                <input type="text" class="box" name="judul" id="judul" required>
                <div class="mt-2">Penulis :</div>
                <input type="text" class="box" name="penulis" id="penulis" required>
                <div class="bagi bagi-2">
                    <div class="mt-2">Penerbit :</div>
                    <input type="text" class="box" name="penerbit" id="penerbit" required>
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-2">Tahun Terbit :</div>
                    <input type="text" class="box" name="tahun_terbit" id="tahun_terbit" required>
                </div>
                <div class="mt-2">Subyek :</div>
                <input type="text" class="box" name="subyek" id="subyek" required>
                <div class="mt-2">Deskripsi Fisik :</div>
                <input type="text" class="box" name="deskripsi_fisik" id="deskripsi_fisik">
                <div class="mt-2">Lokasi :</div>
                <input type="text" class="box" name="lokasi" id="lokasi" required>

                <button class="biru mt-3 lebar-100">Ubah Data</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const edit = data => {
        data = JSON.parse(data);
        munculPopup("#editBuku");
        select("#editBuku #id").value = data.id;
        select("#editBuku #no_klasifikasi").value = data.no_klasifikasi;
        select("#editBuku #judul").value = data.judul;
        select("#editBuku #penulis").value = data.penulis;
        select("#editBuku #penerbit").value = data.penerbit;
        select("#editBuku #tahun_terbit").value = data.tahun_terbit;
        select("#editBuku #subyek").value = data.subyek;
        select("#editBuku #deskripsi_fisik").value = data.deskripsi_fisik;
        select("#editBuku #lokasi").value = data.lokasi;
    }
</script>
@endsection