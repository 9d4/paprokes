@php
    $uri = request()->fullUrl();
    $url = request()->url();

    $dashboard_active = $url == route('dashboard');
    $person_active = str_contains($url, route('person.index'));
    $person_all = $url == route('person.index');
    $person_create = $url == route('person.create');
    $history = str_contains($url, route('history.all'));
    $history_all =   $url == route('history.all');
    $history_reg = $url == route('history.reg');
    $history_unreg = $url == route('history.unreg');
    $history_high = $url == route('history.high');
    $history_normal = $url == route('history.normal');
@endphp
<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="/">{{ env('APP_NAME') }}</a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                   aria-label="Open user menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="44"
                         height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="navbar-collapse collapse" id="navbar-menu" style="">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item @if($dashboard_active) active @endif">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <svg class="nav-link-icon icon icon-tabler icon-tabler-dashboard"
                             xmlns="http://www.w3.org/2000/svg"
                             width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="13" r="2"/>
                            <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"/>
                            <path d="M6.4 20a9 9 0 1 1 11.2 0z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item dropdown @if($person_active) active @endif">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <svg class="nav-link-icon icon icon-tabler icon-tabler-users" xmlns="http://www.w3.org/2000/svg"
                             width="44"
                             height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"/>
                        </svg>
                        <span>People</span>
                    </a>

                    <div class="dropdown-menu @if($person_active) show @endif">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item @if($person_all) active @endif"
                                   href="{{ route('person.index') }}">Daftar Orang</a>
                                <a class="dropdown-item @if($person_create) active @endif"
                                   href="{{ route('person.create') }}">Tambah</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item @if($history) active @endif dropdown">
                    <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="nav-link-icon icon icon-tabler icon-tabler-history" width="44"
                             height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <polyline points="12 8 12 12 14 14"/>
                            <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5"/>
                        </svg>
                        <span class="">History</span>
                    </a>

                    <div class="dropdown-menu  @if($history) show @endif">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item @if($history_all) active @endif"
                                   href="{{ route('history.all') }}">Semua</a>
                                <a class="dropdown-item @if($history_reg) active @endif"
                                   href="{{ route('history.reg') }}">Terdaftar</a>
                                <a class="dropdown-item @if($history_unreg) active
                                   @endif" href="{{ route('history.unreg') }}">Tidak Terdaftar</a>
                                <a class="dropdown-item @if($history_normal) active
                                   @endif" href="{{ route('history.normal') }}">Suhu Normal</a>
                                <a class="dropdown-item @if($history_high) active
                                   @endif" href="{{ route('history.high') }}">Suhu Abnormal</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="nav-link-icon icon icon-tabler icon-tabler-user" width="44"
                             height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="7" r="4"/>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                        </svg>
                        <span class="nav-link-title">
                            {{ \App\Traits\AdminTrait::user()->username }}
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>