@extends('layouts.admin')

@section('title', "Layanan Perpustakaan")

@section('header.action')
<button class="biru" onclick="munculPopup('#addLayanan')">
    <i class="fas fa-plus mr-1"></i> Layanan Baru
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

        <table>
            <thead>
                <tr>
                    <th class="lebar-25">Nama</th>
                    <th>Deskripsi</th>
                    <th class="lebar-20"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layanans as $layanan)
                    <tr>
                        <td>{{ $layanan->name }}</td>
                        <td class="teks-kecil">{{ $layanan->description }}</td>
                        <td>
                            <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="mr-1 teks-hijau pointer" onclick="edit('{{ $layanan }}')">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.layanan.delete', $layanan->id) }}" class="teks-merah" onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="addLayanan">
    <div class="popup">
        <h3 class="p-2 m-0 border-bottom">Tambah Layanan Baru
            <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addLayanan')"></i>
        </h3>
        <div class="wrap">
            <form action="{{ route('admin.layanan.store') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                <div class="mt-2">Nama Layanan :</div>
                <input type="text" class="box" name="name" id="name" required>
                <div class="mt-2">Deskripsi :</div>
                <textarea name="description" id="description" class="box" required></textarea>
                <button class="lebar-100 mt-3 biru">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editLayanan">
    <div class="popup">
        <h3 class="p-2 m-0 border-bottom">Edit Layanan
            <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editLayanan')"></i>
        </h3>
        <div class="wrap">
            <form action="{{ route('admin.layanan.update') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" required>
                <div class="mt-2">Nama Layanan :</div>
                <input type="text" class="box" name="name" id="name" required>
                <div class="mt-2">Deskripsi :</div>
                <textarea name="description" id="description" class="box"></textarea>
                <button class="lebar-100 mt-3 biru">Tambahkan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const edit = data => {
        data = JSON.parse(data);
        munculPopup("#editLayanan");
        select("#editLayanan #name").value = data.name;
        select("#editLayanan #description").value = data.description;
    }
</script>
@endsection