<x-app-layout>
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Overview</div>
                    <h3>Dashboard</h3>
                </div>

            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <x-icon.sign />
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium"id="khmer">កត់ត្រាវត្តមាន</div>
                                        <div class="text-secondary">12 waiting payments</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/shopping-cart -->
                                            <x-icon.prochese />
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium"id="khmer">សុំច្បាប់</div>
                                        <div class="text-secondary">32 shipped</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar">
                                            <x-icon.calendar />
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium"id="khmer">ធ្វើការថែមម៉ោង</div>
                                        <div class="text-secondary">16 today</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/brand-facebook -->
                                            <x-icon.user />
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium" id="khmer">សមាជិក</div>
                                        <div class="text-secondary">21 today</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">កត់ត្រាវត្តមានប្រចាំថ្ងៃ</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-secondary">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" value="8"
                                        size="3" aria-label="Invoices count">
                                </div>
                                entries
                            </div>
                            <div class="ms-auto text-secondary">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm"
                                        aria-label="Search invoice">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-selectable card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                            aria-label="Select all invoices"></th>

                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Checkin</th>
                                    <th>Checkout</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle table-selectable-check"
                                            type="checkbox" aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001401</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                                    <td>
                                        <span class="flag flag-xs flag-country-us me-2"></span>
                                        Carlson Limited
                                    </td>

                                    <td>15 Dec 2017</td>
                                    <td><span class="badge bg-success me-1"></span> Paid</td>
                                    <td class="text-end">
                                        <span class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top"
                                                data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#"> Action </a>
                                                <a class="dropdown-item" href="#"> Another action </a>
                                            </div>
                                        </span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row g-2 justify-content-center justify-content-sm-between">
                            <div class="col-auto d-flex align-items-center">
                                <p class="m-0 text-secondary">Showing <strong>1 to 8</strong> of <strong>16
                                        entries</strong></p>
                            </div>
                            <div class="col-auto">
                                <ul class="pagination m-0 ms-auto">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-left -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path d="M15 6l-6 6l6 6"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-right -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-1">
                                                <path d="M9 6l6 6l-6 6"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END PAGE BODY -->
    <!--  BEGIN FOOTER  -->
    <x-footer />
    <!--  END FOOTER  -->
</x-app-layout>
