@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h1>Riwayat Terdaftar</h1>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="font-weight-bold">
            <tr>
                <td>No</td>
                <td style="min-width: 156px">RFID</td>
                <td style="min-width: 256px">Nama</td>
                <td style="min-width: 15px">Suhu(&deg;C)</td>
                <td style="min-width: 100px">Waktu</td>
            </tr>
            </thead>
            <tbody>
            @php
                $index = 1;
            @endphp
            @foreach($records as $record)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $record->rfid }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->temp }}</td>
                    <td>{{ $record->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection