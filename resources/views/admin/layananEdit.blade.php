@extends('layouts.admin')

@section('title', "Edit Layanan ".$layanan->name)

@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        <form action="{{ route('admin.layanan.update') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $layanan->id }}">
            <div class="mt-2">Nama :</div>
            <input type="text" class="box" name="name" required value="{{ $layanan->name }}">
            <div class="mt-2">Deskripsi :</div>
            <textarea name="description" class="box" style="height: 200px">{{ $layanan->description }}</textarea>

            <div class="bagi bagi-2">
                <div class="wrap">
                    <button onclick="window.history.back(-1)" type="button" class="lebar-100">kembali</button>
                </div>
            </div>
            <div class="bagi bagi-2">
                <div class="wrap">
                    <button class="biru lebar-100">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection