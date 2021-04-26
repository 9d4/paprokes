@extends('layouts.app')

@section('content')
    <div class="page-header mb-3">
        <div class="row">

            <div class="col">
                <h1>Semua Riwayat</h1>
                <div class="d-flex align-items-center">
                    <div class="d-flex mb-2 me-3">
                        <span class=" bg-orange-lt rounded-circle" style="width: 16px; height: 16px"></span>
                        <span class="ps-2 ">&lt; 5 menit</span>
                    </div>
                    <div class="d-flex mb-2 me-3">
                        <span class=" bg-lime-lt rounded-circle" style="width: 16px; height: 16px"></span>
                        <span class="ps-2 ">&lt; 3 menit</span>
                    </div>
                    <div class="d-flex mb-2 me-3">
                        <span class=" bg-blue-lt rounded-circle" style="width: 16px; height: 16px"></span>
                        <span class="ps-2 ">&lt; 1 menit</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <form action="" method="get">
                    <div class="input-group">
                        <input class="form-control form-control-rounded" type="text" name="name" placeholder="Nama..."
                               value="{{ request()->query('name') }}">
                        <button class="btn btn-azure form-control-rounded" type="submit">Cari</button>
                        @if (request()->hasAny('name') && request()->query('name'))
                            <a class="btn btn-danger form-control-rounded" role="button"
                               href="{{ route('history.all') }}">Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <p class="m-0">Total: @if (request()->query('name')) {{ $total }} @else {{ $total_records }} @endif</p>
        @if (!request()->query('name'))
            <div class="d-flex justify-content-center">
                {{ $records->onEachSide(0)->links() }}
            </div>
        @endif
        <table class="table">
            <thead class="font-weight-bold">
            <tr>
                {{--                <td>No</td>--}}
                <td style="min-width: 169px">RFID</td>
                <td style="min-width: 256px">Nama</td>
                <td style="min-width: 15px">
                    @if (!request()->query('name'))
                        @sortablelink('temp', 'Suhu(°C)')
                    @else
                        Suhu(&deg;C)
                    @endif
                </td>
                <td style="min-width: 100px">
                    @if (!request()->query('name'))
                        @sortablelink('created_at', 'waktu')
                    @else
                        Waktu
                    @endif
                </td>
                <td style="min-width: 10px">Terdaftar</td>
            </tr>
            </thead>
            <tbody>
            @foreach($records as $index=>$record)
                <tr class="@if($record['time'] == 3) bg-orange-lt @elseif($record['time'] == 2) bg-lime-lt @elseif($record['time'] == 1) bg-blue-lt @endif">
                    <td>{{ $record['rfid'] }}</td>
                    <td>
                        @if ($record['name'])
                            {{ $record['name'] }}
                        @else
                            <form action="{{ route('person.create') }}">
                                <input type="hidden" name="rfid" value="{{$record['rfid']}}">
                                <button class="btn btn-sm btn-ghost-facebook" type="submit">Tambahkan</button>
                            </form>
                        @endif
                    </td>
                    <td>{{ $record['temp'] }}</td>
                    <td>{{ $record['created_at'] }}</td>
                    <td>
                        @if($record['registered'])
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                 width="44"
                                 height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bc62d" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="44"
                                 height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fd0061" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if (!request()->query('name'))
        <div class="d-flex justify-content-center">
            {{ $records->onEachSide(0)->links() }}
        </div>
    @endif
@endsection