@extends('dash.realtime.base')
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead class="font-weight-bold">
            <tr>
                <td style="min-width: 33px">Id</td>
                <td style="min-width: 192px">RFID</td>
                <td style="min-width: 256px">Nama</td>
                <td style="min-width: 17px">Suhu</td>
                <td style="min-width: 192px">Waktu</td>
                <td style="min-width: 10px">Terdaftar</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="rec in records" v-bind:key="rec.id" :class="{'table-danger':rec.temp >= 37}">
                <td>@{{ rec.id }}</td>
                <td>@{{ rec.rfid }}</td>

                <td>
                    @{{ rec['name'] }}
                </td>
                <td>@{{ rec['temp'] }}</td>
                <td><b>@{{ parseTime(rec['time']) }}</b> - @{{ parseDate(rec['time']) }}</td>
                <td>
                    <svg v-if="rec.registered" xmlns="http://www.w3.org/2000/svg"
                         class="icon icon-tabler icon-tabler-check"
                         width="21"
                         height="21" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bc62d" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="21"
                         height="21" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fd0061" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <p>End of table.</p>
@endsection