@extends('layouts.auth')

@section('title', "Login Admin")

@section('content')
<h1 class="rata-tengah">Login Admin</h1>

@if ($message != "")
    <div class="bg-hijau-transparan rounded p-2 mb-3">
        {{ $message }}
    </div>
@endif

<form action="#" method="POST">
    {{ csrf_field() }}
    <div class="mt-2">Email :</div>
    <input type="email" class="box" name="email" required>
    <div class="mt-2">Password :</div>
    <input type="password" class="box" name="password" required>

    <button class="lebar-100 mt-3 biru">Login</button>
</form>
@endsection