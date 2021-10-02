@extends('layouts.admin')

@section('title', "Dashboard")

@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        @if ($message != "")
            <div class="bg-hijau-transparan rounded p-2 mb-2">
                {{ $message }}
            </div>
        @endif
    </div>
</div>
@endsection