<x-layout title="Records of {{ $device->device_id }}"
          page-title="Records: {{ $device->name }}"
          page-subtitle="All">
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                {{--                <td>No</td>--}}
                <td style="min-width: 187px">RFID</td>
                <td style="min-width: 256px">Name</td>
                <td style="min-width: 15px">
                    @if (!request()->query('name'))
                        @sortablelink('temp', 'Temp(°C)')
                    @else
                        Temp(&deg;C)
                    @endif
                </td>
                <td style="min-width: 100px">
                    @if (!request()->query('name'))
                        @sortablelink('created_at', 'On')
                    @else
                        On
                    @endif
                </td>
                <td style="min-width: 10px">Registered</td>
            </tr>
            </thead>
        </table>
        @foreach($records as $record)
            <p>{{ $record->rfid }}</p>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $records->onEachSide(0)->links() }}
    </div>
</x-layout>