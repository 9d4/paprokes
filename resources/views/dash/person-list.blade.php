@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h1>Semua orang</h1>
            </div>
            <div class="col d-flex align-items-start justify-content-end">
                <a role="button" class="btn btn-azure" href="{{ route('person.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="44"
                         height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Tambah
                </a>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                Dihapus
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="font-weight-bold">
            <tr>
                <td>No</td>
                <td style="min-width: 156px">RFID</td>
                <td style="min-width: 256px">Nama</td>
                <td style="min-width: 160px"></td>
            </tr>
            </thead>
            <tbody>
            @php
                $index = 1;
            @endphp
            @foreach($people as $person)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $person->rfid }}</td>
                    <td>{{ $person->name }}</td>
                    <td class="d-flex justify-content-end">
                        <a class="px-2 btn btn-sm btn-ghost-warning"
                           href="{{ route('person.edit', ['person'=>$person->id]) }}">Edit</a>
                        <form action="{{ route('person.destroy', ['person' => $person->id]) }}" method="post">
                            <button class="btn btn-sm btn-ghost-danger" type="submit">Hapus</button>
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection