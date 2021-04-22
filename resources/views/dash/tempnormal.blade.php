@extends('layouts.app')

@section('content')
    <div class="page-header mb-3">
        <div class="row">

            <div class="col">
                <h1>Suhu Normal</h1>

            </div>
            <div class="col">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <p class="m-0">Total: {{ $total }}</p>
        <table class="table">
            <thead class="font-weight-bold">
            <tr>
                <td>No</td>
                <td style="min-width: 169px">RFID</td>
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
                    <td>
                        @if ($record->name)
                            {{ $record->name }}
                        @else
                            <form action="{{ route('person.create') }}">
                                <input type="hidden" name="rfid" value="{{$record->rfid}}">
                                <button class="btn btn-sm btn-ghost-facebook" type="submit">Tambahkan</button>
                            </form>
                        @endif
                    </td>
                    <td>{{ $record->temp }}</td>
                    <td>{{ $record->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection