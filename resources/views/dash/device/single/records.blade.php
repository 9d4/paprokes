@inject("deviceService", "DeviceService")
@inject("peopleService", "PeopleService")

<x-layout title="Records of {{ $device->device_id }}"
          page-title="Records: {{ $device->name }}"
          page-subtitle="All">
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <td style="min-width: 32px"><i class="fas fa-user-check"></i></td>
                <td style="min-width: 187px">RFID</td>
                <td style="min-width: 256px">Name</td>
                <td style="min-width: 111px">
                    @if (!request()->query('name'))
                        @sortablelink('temp', 'Temp(°C)')
                    @else
                        Temp(&deg;C)
                    @endif
                </td>
                <td style="min-width: 160px">
                    @if (!request()->query('name'))
                        @sortablelink('created_at', 'On')
                    @else
                        On
                    @endif
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($records as $record)
                <tr>
                    <td>
                        @if (!!$name = $peopleService->getNameByRfid($record->rfid))
                            <i class="fas fa-check-circle text-green"></i>
                        @else
                            <i class="fas fa-times-circle text-danger"></i>
                        @endif
                    </td>
                    <td>{{ $record->rfid }}</td>
                    <td>{{ $name }}</td>
                    <td>{{ $record->temp }}</td>
                    <td>{{ $record->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $records->onEachSide(0)->links() }}
    </div>
</x-layout>