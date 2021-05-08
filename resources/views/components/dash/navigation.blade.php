@inject('user', 'UserService')
@inject('nav', 'NavService')
@inject('dev', 'DeviceService')
@inject('Str', "\Illuminate\Support\Str")

<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('index') }}" class="nav-link @if($nav->dash_active) active @endif">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block dropdown">
            <a role="button" class="nav-link dropdown-toggle" data-toggle="dropdown">My Devices</a>
            <div class="dropdown-menu dropdown-menu-left">
                <a href="{{ route('device.index') }}" class="dropdown-item">All</a>
                <div class="dropdown-divider"></div>
                @foreach($dev->myDevicesFirstTen() as $device)
                    <a class="dropdown-item" href="{{ route('device.show', ['device' => $device->device_id]) }}">{{ $device->name }}</a>
                @endforeach
                <div class="dropdown-divider"></div>
                <div class="dropdown-footer">Click all to see all devices</div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('device.create') }}">New Device</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{ $Str->words($user->current()->name, 1, '') }}
                <i class="right fas fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right bg-dark text-light">
                <li><a class="dropdown-item" href="#">{{ $user->current()->username }}</a></li>
                <li class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>