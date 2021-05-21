@inject("peopleService", "PeopleService")
@inject("deviceService", "DeviceService")

<x-layout title="Realtime Record - {{ request()->route('device') }}"
          page-title="Realtime: {{ $deviceService->getDeviceName(request()->route('device'))  }}"
          page-subtitle="All">
    <script>
        let app = {!! json_encode([
            'csrf' => csrf_token(),
            'baseUrl' => route('index'),
            'pusherKey' => env('PUSHER_APP_KEY'),
            'pusherCluster' => env('PUSHER_APP_CLUSTER'),
            'channel' => config('channel.record') . '.' . request()->route('device'),
            'device_id' => request()->route('device'),
        ]) !!}
    </script>
    <div class="table-responsive" id="realtimeTable">
        <table>
            <thead>
            <tr>
                <td style="min-width: 32px"><i class="fas fa-user-check"></i></td>
                <td style="min-width: 187px">RFID</td>
                <td style="min-width: 256px">Name</td>
                <td style="min-width: 111px">Temp(&deg;C)</td>
                <td style="min-width: 160px">On</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="record in records" :key="record.id">
                <td>
                    <i class="fas fa-check-circle text-green" v-if="record.registered"></i>
                    <i class="fas fa-times-circle text-danger" v-else></i>
                </td>
                <td>@{{ record.rfid }}</td>
                <td>@{{ record.name }}</td>
                <td>@{{ record.temp }}</td>
                <td>@{{ parseTime(record.time) }}</td>
            </tr>
            {{--            @foreach($records as $record)--}}
            {{--                <tr>--}}
            {{--                    <td>--}}
            {{--                        @if (!!$name = $peopleService->getNameByRfid($record->rfid))--}}
            {{--                            <i class="fas fa-check-circle text-green"></i>--}}
            {{--                        @else--}}
            {{--                            <i class="fas fa-times-circle text-danger"></i>--}}
            {{--                        @endif--}}
            {{--                    </td>--}}
            {{--                    <td>{{ $record->rfid }}</td>--}}
            {{--                    <td>{{ $name }}</td>--}}
            {{--                    <td>{{ $record->temp }}</td>--}}
            {{--                    <td>{{ $record->created_at }}</td>--}}
            {{--                </tr>--}}
            {{--            @endforeach--}}
            </tbody>
        </table>
    </div>
    <script src="{{ asset('v2-assets/js/realtime-page.js') }}" defer></script>
</x-layout>