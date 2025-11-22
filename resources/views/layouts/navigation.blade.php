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
                <img src="images/Logo.png" alt="" style="width:auto; height:40px;">
            </a>
        </div>
        <!-- END NAVBAR LOGO -->
        <div class="navbar-nav flex-row order-md-last">


            <!-- User Menu -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
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
                    <a href="./profile.html" class="dropdown-item">Profile</a>

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
                                <a class="nav-link" href="./">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.home />
                                    </span>
                                    <span class="nav-link-title" id="khmer">ផ្ទាំងដើម </span>
                                </a>
                            </li>
                            @if (in_array(Auth::user()->role->role, ['owner','admin']))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('attendance.index')}}">
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
                                    <a class="dropdown-item" href="./form-elements.html">ស្មើរសុំច្បាប់</a>
                                    <a class="dropdown-item" href="{{ route('leave-types.index') }}">ប្រភេទច្បាប់</a>
                                    <a class="dropdown-item" href="./form-elements.html">ច្បាប់លើសកំណត់</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.calendar />
                                    </span>
                                    <span class="nav-link-title" id="khmer"> ធ្វើការថែមម៉ោង </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item " href="">ស្នើរសុំធ្វើការថែមម៉ោង</a>
                                            <a class="dropdown-item" href="./chat.html"> របាយការណ៍ </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
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
                                            <a class="dropdown-item " href="{{ route('members.index') }}">សមាជិក</a>
                                            <a class="dropdown-item " href="{{ route('worktimes.index') }}">
                                                ម៉ោងធ្វើការ</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-plugins" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.scan />
                                    </span>
                                    <span class="nav-link-title" id="khmer"> ស្កេនមិនកំណត់ </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./charts.html"> បញ្ជីស្កេន</a>
                                    <a class="dropdown-item" href="./colorpicker.html">របាយការណ៍</a>
                                </div>
                            </li> --}}
                            @if (Auth::user()->role->role === 'owner')
                            <li class="nav-item dropdown">

                                <a class="nav-link" href="">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.user />
                                    </span>
                                    <span class="nav-link-title" id="khmer">បញ្ជីអ្នកប្រើប្រាស់ </span>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.help />
                                    </span>
                                    <span class="nav-link-title" id="khmer"> ជំនួយការផ្សេងៗ </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="https://tabler.io/docs" target="_blank"
                                        rel="noopener">
                                        Documentation </a>
                                    <a class="dropdown-item" href="./changelog.html"> Changelog </a>
                                    <a class="dropdown-item" href="https://github.com/tabler/tabler" target="_blank"
                                        rel="noopener"> Source code </a>
                                    <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm"
                                        target="_blank" rel="noopener">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/heart -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-inline me-1 icon-2">
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572">
                                            </path>
                                        </svg>
                                        Sponsor project!
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <!-- END NAVBAR MENU -->
                    </div>
                    <div class="col col-md-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasSettings">

                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/settings -->
                                        <x-icon.setting />
                                    </span>
                                    <span class="nav-link-title" id="khmer">កំណត់</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>