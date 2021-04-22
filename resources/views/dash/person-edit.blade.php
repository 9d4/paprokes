@extends('layouts.app')

@section('content')
    <div class="page-header mb-3">
        <h1>Edit</h1>
        <span>RFID: <span class="font-weight-bold">{{ $person->rfid }}</span></span>
    </div>

    <form action="{{ route('person.update', ['person' => $person->id]) }}" method="post">
        <div class="mb-3">
            <label class="form-label" for="rfid">RFID</label>
            <input class="form-control @error('rfid') is-invalid @enderror" type="text" id="rfid" name="rfid"
                   placeholder="XX XX XX " value="{{ $person->rfid }}" required>
            <div class="invalid-feedback">{{ $errors->first('rfid') }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="name">Nama</label>
            <input class="form-control  @error('name') is-invalid @enderror" type="text" id="name" name="name"
                   placeholder="John Doe" value="{{ $person->name }}" required>
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        </div>

        <button class="d-flex ms-auto btn btn-azure" type="submit">Tambah</button>
        @csrf
        @method('PATCH')
    </form>
    <script>
        document.querySelector('#rfid').focus();
    </script>
@endsection