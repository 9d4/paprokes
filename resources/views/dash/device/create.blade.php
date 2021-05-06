<x-layout title="Register New Device" page-title="New Device">
    @if(session('success'))
        <div class="alert alert-default-primary alert-dismissible fade show">
            <i class="fas fa-check-circle"></i>
            Your device has been added
            <button class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <form action="{{ route('device.store') }}" method="post">
        <div class="form-group">
            <label for="input_name">Device Name</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="input_name"
                   value="{{ old('name') }}">
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            <small class="form-text">Give your device a name</small>
        </div>
        @csrf
        <button type="submit" class="btn btn-primary">Add Device</button>
        <script>document.querySelector('#input_name').focus()</script>
    </form>
</x-layout>