<x-layout title="My Devices" page-title="My Devices">
    @if(!!$devices->count())
        <div class="accordion" id="deviceList">
            @foreach($devices as $device)
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-block btn-link text-light text-left px-0" type="button"
                                data-toggle="collapse"
                                data-target="#device{{ $device->device_id }}">
                            {{ $device->name }}
                        </button>
                    </div>
                    <div id="device{{ $device->device_id }}" class="collapse">
                        <div class="card-body">
                            <small>Added on: {{ $device->added_on }}</small>
                            <a role="button" href="{{ route('device.show', ['device' => $device->device_id]) }}"
                               class="float-right btn btn-info btn-sm">
                                Stats
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <section>
                                <p>Api Key:</p>
                                <pre class="bg-secondary">{{ $device->key->api_key }}</pre>
                            </section>
                            <section>
                                <p>Request:</p>
                                <pre class="bg-secondary">GET ...</pre>
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