<x-layout title="My Devices" page-title="My Devices">
    @if(session('deleted'))
        <div class="alert alert-default-primary alert-dismissible fade show">
            <i class="fas fa-check-circle"></i>
            Your device has been deleted
            <button class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if(!!$devices->count())
        <div class="accordion" id="deviceList">
            @foreach($devices as $device)
                <div class="card">
                    <div class="card-header align-items-start d-flex justify-content-between">
                        <button class="btn btn-block btn-link text-light text-left px-0"
                                type="button"
                                data-toggle="collapse"
                                data-target="#device{{ $device->device_id }}">
                            <span style="hyphens: auto;word-break: break-word">{{ $device->name }}</span>
                        </button>
                        <a role="button" href="{{ route('device.show', ['device' => $device->device_id]) }}"
                           class="float-right text-nowrap btn btn-link text-light">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div id="device{{ $device->device_id }}" class="collapse">
                        <div class="card-body">
                            <small>Added on: {{ $device->added_on }}</small>
                            <section>
                                <p>Api Key:</p>
                                <pre class="bg-secondary">{{ $device->key->api_key }}</pre>
                            </section>
                            <section>
                                <p>Request:</p>
                                <pre class="bg-secondary">GET        {{ route('api.newRecord') }}?api_key={{ $device->key->api_key }}&rfid=xxxxxxx&temp=xx.xx

PARAMETERS
api_key    required
rfid       required
temp       optional|nullable</pre>
                            </section>
                            <section class="mt-3">
                                <button class="btn btn-danger"
                                        data-delete="device"
                                        data-id="{{ $device->device_id }}"
                                        data-name="{{ $device->name }}"
                                        data-route="{{ route('device.destroy', ['device' => $device->device_id]) }}">
                                    Delete
                                </button>
                            </section>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="mt-5 text-center">
            <i class="fas fa-10x fa-meh-blank mb-3"></i>
            <h5>You don't have any device yet</h5>
            <a class="btn btn-primary" role="button" href="{{ route('device.create') }}"><i class="fa fa-plus"></i>
                Register New</a>
        </div>
    @endif
</x-layout>