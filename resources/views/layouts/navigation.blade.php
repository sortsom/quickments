<link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet" />
<link href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css" rel="stylesheet">
<script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <!-- BEGIN NAVBAR TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- END NAVBAR TOGGLER -->
        <!-- BEGIN NAVBAR LOGO -->
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-2">
            <a href="." aria-label="Tabler">
                <img src="{{ asset('images/Logo.png') }}" alt="" style="width:auto; height:40px;">
            </a>
        </div>
        <!-- END NAVBAR LOGO -->
        <div class="navbar-nav flex-row order-md-last">


            <!-- User Menu -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'storage/default.png' }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-secondary">
                            {{ Auth::user()->role->role ?? 'no-role' }}
                        </div>
                    </div>

                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>

                    <div class="dropdown-divider"></div>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>

            </div>
        </div>

</header>
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <div class="row flex-column flex-md-row flex-fill align-items-center">
                    <div class="col">
                        <!-- BEGIN NAVBAR MENU -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.home />
                                    </span>
                                    <span class="nav-link-title" id="khmer">ផ្ទាំងដើម </span>
                                </a>
                            </li>
                            @if (in_array(Auth::user()->role->role, ['owner', 'admin']))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('attendance.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <x-icon.stock />
                                        </span>
                                        <span class="nav-link-title" id="khmer">កត់ត្រាវត្តមាន </span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-form" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.prochese />
                                    </span>
                                    <span class="nav-link-title" id="khmer"> សុំច្បាប់ </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('requestleave.index') }}">ស្មើរសុំច្បាប់</a>
                                    @if (in_array(Auth::user()->role->role, ['owner']))
                                        <a class="dropdown-item"
                                            href="{{ route('leave-types.index') }}">ប្រភេទច្បាប់</a>
                                    @endif
                                </div>
                            </li>
                            @if (in_array(Auth::user()->role->role, ['owner', 'admin']))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <x-icon.folder-dollas />
                                        </span>
                                        <span class="nav-link-title" id="khmer"> សមាជិក </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item "
                                                    href="{{ route('members.index') }}">សមាជិក</a>
                                                <!-- <a class="dropdown-item " href="{{ route('worktimes.index') }}">
                                                ម៉ោងធ្វើការ</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->role->role === 'owner')
                                <li class="nav-item dropdown">

                                    <a class="nav-link" href="{{ route('users.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <x-icon.user />
                                        </span>
                                        <span class="nav-link-title" id="khmer">បញ្ជីអ្នកប្រើប្រាស់ </span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.pdf />
                                    </span>
                                    <span class="nav-link-title" id="khmer"> របាយការណ៍ </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item "
                                        href="{{ route('attendance.report') }}">របាយការណ៍វត្តមាន</a>
                                    <a class="dropdown-item" href="{{ route('requestleave.report') }}">
                                        របាយការណ៍សុំច្បាប់
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <!-- END NAVBAR MENU -->
                    </div>
                    @if (Auth::user()->role->role === 'owner')
                        <div class="col col-md-auto">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <x-icon.setting />
                                        </span>
                                        <span class="nav-link-title" id="khmer">កំណត់</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</header>
