@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Riwayat Tidak Terdaftar</h1>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="font-weight-bold">
            <tr>
                <td>No</td>
                <td style="min-width: 156px">RFID</td>
                <td style="min-width: 15px">Suhu(&deg;C)</td>
                <td style="min-width: 100px">Waktu</td>
                <td></td>
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
                    <td>{{ $record->temp }}</td>
                    <td>{{ $record->created_at }}</td>
                    <td>
                        <form action="{{ route('person.create') }}">
                            <input type="hidden" name="rfid" value="{{$record->rfid}}">
                            <button class="btn btn-sm btn-ghost-facebook" type="submit">Tambahkan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div
@endsection