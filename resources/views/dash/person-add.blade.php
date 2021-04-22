@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Tambahkan Orang</h1>
    </div>

    <form action="{{ route('person.store') }}" method="post">

        @if(session('success'))
            <div class="alert alert-success">
                Ditambahkan
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label" for="rfid">RFID</label>
            <input class="form-control @error('rfid') is-invalid @enderror" type="text" id="rfid" name="rfid"
                   placeholder="XX XX XX " required value="{{ request()->query('rfid') }}">
            <div class="invalid-feedback">{{ $errors->first('rfid') }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="name">Nama</label>
            <input class="form-control  @error('name') is-invalid @enderror" type="text" id="name" name="name"
                   placeholder="John Doe" required>
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        </div>

        <button class="d-flex ms-auto btn btn-azure" type="submit">Tambah</button>
        @csrf
    </form>
    <script>
        document.querySelector('#rfid').focus();
    </script>
@endsection