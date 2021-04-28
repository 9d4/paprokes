@extends('layouts.app')

@section('content')
    <div class="page-header mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1>Welcome, {{ \App\Traits\AdminTrait::user()->username }}</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 py-2">
            <a href="{{ route('history.all') }}" class="text-decoration-none">
                <div class="card shadow text-light bg-azure">
                    <div class="card-body">
                        <span class="font-weight-light h1">Masuk</span>
                        <p class="display-3 font-weight-bold">{{ $total_in_today }}</p>
                        <div class="d-flex justify-content-between">
                            <p class="">Hari Ini</p>
                            <button onclick="realtimePage(event)" class="btn btn-sm btn-flickr">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 9v2m0 4v.01" />
                                    <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                </svg>
                                Realtime (beta)
                            </button>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <script>
            function realtimePage(e) {
                e.preventDefault();
                location.href = "{{ route('beta.realtime') }}";
            }
        </script>

        <div class="col-12 col-sm-6 py-2">
            <a href="{{ route('history.all') }}" class="text-decoration-none">
                <div class="card shadow bg-azure text-light">
                    <div class="card-body">
                        <span class="font-weight-light h1">Total Rekaman</span>
                        <p class="display-3 font-weight-bold">{{ $total_in }}</p>
                        <p>{{ $first_rec_date }} - {{ $last_rec_date }}</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 py-2">
            <a href="{{ route('history.reg') }}" class="text-decoration-none">
                <div class="card shadow text-light bg-facebook">
                    <div class="card-body">
                        <span class="font-weight-light h1">Terdaftar</span>
                        <p class="display-3 font-weight-bold">{{ $total_reg }}</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 py-2">
            <a href="{{ route('history.unreg') }}" class="text-decoration-none">
                <div class="card shadow bg-instagram text-light">
                    <div class="card-body">
                        <span class="font-weight-light h1">Tidak Terdaftar</span>
                        <p class="display-3 font-weight-bold">{{ $total_unreg }}</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 py-2">
            <a href="{{ route('history.normal') }}" class="text-decoration-none">
                <div class="card shadow text-light bg-green">
                    <div class="card-body">
                        <span class="font-weight-light h1">Suhu Normal</span>
                        <div class="row">
                            <div class="col-6">
                                <p class="display-3 font-weight-bold">{{ $total_normal }}</p>
                                <span>Keseluruhan</span>
                            </div>
                            <div class="col-6">
                                <p class="display-3 font-weight-bold">{{ $total_normal_today }}</p>
                                <span>Hari ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 py-2">
            <a href="{{ route('history.high') }}" class="text-decoration-none">
                <div class="card shadow bg-red text-light">
                    <div class="card-body">
                        <span class="font-weight-light h1">Suhu Abnormal</span>
                        <div class="row">
                            <div class="col-6">
                                <p class="display-3 font-weight-bold">{{ $total_not_normal }}</p>
                                <span>Keseluruhan</span>
                            </div>
                            <div class="col-6">
                                <p class="display-3 font-weight-bold">{{ $total_not_normal_today }}</p>
                                <span>Hari ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-xxl-6 py-2">
            <div class="card shadow">
                <div class="card-body">
                    <p class="font-weight-medium h3">Riwayat Suhu Hari Ini</p>
                    <div id="temps_today"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xxl-6 py-2">
            <div class="card shadow">
                <div class="card-body">
                    <p class="font-weight-medium h3">Semua Riwayat Suhu</p>
                    <div id="temps_all"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/apexcharts.js') }}"></script>
    <script>
        let temps_today = JSON.parse('[{!! $temps_today !!}]');
        let timestamps_today = JSON.parse('[{!! $timestamps_today !!}]');
        let temps_all = JSON.parse('[{!! $temps_all !!}]');
        let timestamps_all = JSON.parse('[{!! $timestamps_all !!}]');
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('temps_today'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: true,
                    },
                    animations: {
                        enabled: true
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "straight",
                },
                series: [{
                    name: "Suhu",
                    data: temps_today,
                }],
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    // type: 'time',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                    type: 'number',
                },
                labels: timestamps_today,
                colors: ["#206bc4"],
                legend: {
                    show: false,
                    position: 'bottom',
                    offsetY: 12,
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 100,
                    },
                    itemMargin: {
                        horizontal: 8,
                        vertical: 8
                    },
                },
            })).render();
            window.ApexCharts && (new ApexCharts(document.getElementById('temps_all'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: true,
                    },
                    animations: {
                        enabled: true
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "straight",
                },
                series: [{
                    name: "Suhu",
                    data: temps_all,
                }],
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: timestamps_all,
                colors: ["#17A2B9"],
                legend: {
                    show: true,
                    position: 'bottom',
                    offsetY: 12,
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 100,
                    },
                    itemMargin: {
                        horizontal: 8,
                        vertical: 8
                    },
                },
            })).render();
        });
    </script>
@endsection
