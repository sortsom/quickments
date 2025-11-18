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
            <!-- Theme Toggle -->
            <div class="nav-item d-none d-md-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" aria-label="Enable dark mode" data-bs-original-title="Enable dark mode">
                    <!-- Moon Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-1">
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z">
                        </path>
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" aria-label="Enable light mode"
                    data-bs-original-title="Enable light mode">
                    <!-- Sun Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-1">
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7">
                        </path>
                    </svg>
                </a>
            </div>

            <!-- Notifications (Visible on all screen sizes) -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" aria-label="Show notifications"
                    data-bs-auto-close="outside">
                    <!-- Bell Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-1">
                        <path
                            d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                        </path>
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                    </svg>
                    <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                    <!-- Notification Card -->
                    <div class="card">
                        <div class="card-header d-flex">
                            <h3 class="card-title">Notifications</h3>
                            <div class="btn-close ms-auto" data-bs-dismiss="dropdown"></div>
                        </div>
                        <div class="list-group list-group-flush list-group-hoverable">
                            <!-- Notification Items (Example 1–4) -->
                            <!-- Repeatable block omitted for brevity -->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col"><a href="#" class="btn btn-2 w-100">Archive all</a></div>
                                <div class="col"><a href="#" class="btn btn-2 w-100">Mark all as read</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(./images/profile.jpg)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>Sort Som</div>
                        <div class="mt-1 small text-secondary">UI Designer</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Status</a>
                    <a href="./profile.html" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Feedback</a>

                    <div class="dropdown-divider"></div>

                    <a href="./settings.html" class="dropdown-item">Settings</a>

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
                                        <x-icon.home /></span>
                                    <span class="nav-link-title" id="khmer">ផ្ទាំងដើម </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.stock /></span>
                                    <span class="nav-link-title" id="khmer">កត់ត្រាវត្តមាន </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-form" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.prochese /></span>
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
                                            <a class="dropdown-item " href=""> ម៉ោងធ្វើការ</a>
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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-addons" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-icon.user />
                                    </span>
                                    <span class="nav-link-title" id="khmer">តួនាទីអ្នកប្រើប្រាស់</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./icons.html">កំណត់សិទ្ធិ</a>
                                    <a class="dropdown-item" href="./emails.html">មុខងារ</a>
                                </div>
                            </li>
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
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
