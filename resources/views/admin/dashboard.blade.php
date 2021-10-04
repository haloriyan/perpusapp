@extends('layouts.admin')

@section('title', "Dashboard")

@section('head.dependencies')
<style>
    .listWrapper li {
        list-style: none;
        border-bottom: 1px solid #ddd;
        padding: 15px 0px;
    }
</style>
@endsection

@section('content')
<div class="bagi bagi-3">
    <div class="wrap">
        <a href="{{ route('admin.visitor') }}">
            <div class="bg-putih rounded bayangan-5 smallPadding">
                <div class="wrap super">
                    <h2>{{ $visitors->count() }}</h2>
                    <div class="teks-kecil">pengunjung bulan ini</div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="bagi bagi-3">
    <div class="wrap">
        <a href="{{ route('admin.buku') }}">
            <div class="bg-putih rounded bayangan-5 smallPadding">
                <div class="wrap super">
                    <h2>{{ $books->count() }}</h2>
                    <div class="teks-kecil">koleksi buku</div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="bagi bagi-3">
    <div class="wrap">
        <a href="{{ route('admin.layananPerpustakaan') }}">
            <div class="bg-putih rounded bayangan-5 smallPadding">
                <div class="wrap super">
                    <h2>{{ $services->count() }}</h2>
                    <div class="teks-kecil">total layanan</div>
                </div>
            </div>
        </a>
    </div>
</div>
<br />
<div class="bagi bagi-2">
    <div class="wrap">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <h2 class="m-0">Buku</h2>
                <div class="mt-1 mb-2 teks-kecil">yang sering ditanyakan</div>
                
                <div class="listWrapper">
                    @foreach ($famousBooks as $bookName => $counter)
                        <li>
                            {{ $bookName }}
                            <div class="mt-1 teks-kecil teks-transparan">{{ $counter }}x ditanyakan</div>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bagi bagi-2">
    <div class="wrap">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <h2 class="m-0">Layanan</h2>
                <div class="mt-1 mb-2 teks-kecil">yang sering ditanyakan</div>
                
                <div class="listWrapper">
                    @foreach ($famousServices as $name => $count)
                        <li>
                            {{ $name }}
                            <div class="mt-1 teks-kecil teks-transparan">{{ $count }}x ditanyakan</div>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection