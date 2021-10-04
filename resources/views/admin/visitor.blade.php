@extends('layouts.admin')

@section('title', "Data Pengunjung")

@section('head.dependencies')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp

@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th class="lebar-20"><i class="fas fa-clock"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitors as $visitor)
                    @php
                        $createdAt = Carbon::parse($visitor->created_at);
                    @endphp
                    <tr>
                        <td>{{ $visitor->name }}</td>
                        <td>
                            {{ $createdAt->isoFormat('DD MMMM YYYY') }}
                            <div class="mt-1 teks-kecil">{{ $createdAt->format('H:i') }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="rata-tengah mt-4">
            {{ $visitors->links() }}
        </div>
    </div>
</div>
@endsection