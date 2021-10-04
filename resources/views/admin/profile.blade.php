@extends('layouts.admin')

@section('title', "Profile")

@section('head.dependencies')
<style>
    #previewArea,#formArea { transition: 0.4s; }
    .content .icon {
        display: inline-block;
        width: 120px;
        line-height: 120px;
        background-color: #3498db;
        color: #fff;
        border-radius: 900px;
        font-size: 25px;
        font-family: RobotoBold;
        margin-top: -100px;
        border: 10px solid #fff;
        position: relative;
        top: -50px;
    }
    #previewArea h2 {
        margin-top: -20px;
    }
</style>
@endsection

@section('content')
<div class="bagi lebar-100" id="previewArea">
    <div class="wrap">
        <div class="tinggi-50"></div>
        <div class="bg-putih rounded bayangan-5 smallPadding rata-tengah">
            <div class="wrap">
                <div class="icon">{{ $myData->initial }}</div>
                <h2 class="mt-0">{{ $myData->name }}</h2>
                <div>{{ $myData->email }}</div>

                <div class="bagi bagi-2 mt-2 buttonArea">
                    <div class="wrap">
                        <button onclick="toggle('#formProfile', this)" class="lebar-100"><i class="fas fa-user mr-1"></i> Edit Profil</button>
                    </div>
                </div>
                <div class="bagi bagi-2 mt-2 buttonArea">
                    <div class="wrap">
                        <button onclick="toggle('#formPassword', this)" class="lebar-100"><i class="fas fa-lock mr-1"></i> Ubah Password</button>
                    </div>
                </div>

                @if ($message != "")
                    <div class="bg-hijau-transparan rounded p-2 mt-2 rata-kiri">
                        {{ $message }}
                    </div>
                @endif
                @if ($errors->count() != 0)
                    @foreach ($errors->all() as $err)
                        <div class="bg-merah-transparan rounded p-2 mt-2 rata-kiri">
                            {{ $err }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<div class="bagi lebar-50 d-none" id="formArea">
    <div class="wrap">
        <div id="formProfile" class="d-none form">
            <div class="bg-putih rounded bayangan-5">
                <h3 class="m-0 border-bottom p-2">Edit Profil</h3>
                <div class="smallPadding">
                    <div class="wrap super">
                        <form action="{{ route('admin.admin.update') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="from_profile" value="1">
                            <input type="hidden" name="id" value="{{ $myData->id }}">
                            <div class="mt-2">Nama :</div>
                            <input type="text" class="box" name="name" required value="{{ $myData->name }}">
                            <div class="mt-2">Email :</div>
                            <input type="email" class="box" name="email" required value="{{ $myData->email }}"> 

                            <button class="lebar-100 mt-2 hijau">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="formPassword" class="d-none form">
            <div class="bg-putih rounded bayangan-5">
                <h3 class="m-0 border-bottom p-2">Edit Password</h3>
                <div class="smallPadding">
                    <div class="wrap super">
                        <form action="{{ route('admin.admin.updatePassword') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="mt-2">Password Lama :</div>
                            <input type="password" class="box" name="old_password" required>
                            <div class="mt-2">Password Baru :</div>
                            <input type="password" class="box" name="new_password" required>
                            <div class="mt-2">Ulangi Password Baru :</div>
                            <input type="password" class="box" name="retype_password" required>

                            <button class="lebar-100 mt-2 hijau">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')
<script>
    const toggle = (type, btn) => {
        select("#previewArea").classList.remove('lebar-100')
        select("#previewArea").classList.add('lebar-50')
        selectAll("#previewArea .buttonArea").forEach(area => {
            area.classList.remove('bagi-2','mt-2');
            area.classList.add('lebar-100');
        });
        selectAll("#previewArea .buttonArea button").forEach(button => {
            button.classList.remove('biru');
        })
        btn.classList.add('biru');
        select("#formArea").classList.remove('d-none');
        
        selectAll("#formArea .form").forEach(form => form.classList.add('d-none'));
        select(`#formArea ${type}`).classList.remove('d-none');
    }
</script>
@endsection