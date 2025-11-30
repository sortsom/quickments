<x-app-layout>

    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Overview</div>
                    <h3>សមាជិក</h3>
                </div>
                <div class="d-print-none col-auto ms-auto">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#modal-add">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                            <x-icon.plus />
                            <span>បង្កើតថ្មី</span>
                        </a>
                        <a href="#" class="btn btn-primary btn-5 d-sm-none btn-icon d-sm-inline-flex"
                            data-bs-toggle="modal" data-bs-target="#modal-add" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                            <x-icon.pluses />
                        </a>
                    </div>

                    {{-- <!-- BEGIN MODAL -->
                    <x-popup id="modal-add" title="បន្ថែមសមាជិកថ្មី">
                        <x-members.add />
                    </x-popup>
                    <!-- END MODAL --> --}}
                </div>

            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <!-- <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const list = new List('table-', {
                            sortClass: 'table-sort',
                            listClass: 'table-tbody',
                            valueNames: ['sort-name', 'sort-content', 'sort-status', 'sort-date', 'sort-tags',
                                'sort-category'
                            ]
                        });
                    })
                </script> -->
                <div class="card">
                    <x-alert-messege />
                    <div class="card-table">
                        <div class="card-header">
                            <div class="row w-full align-items-center">
                                <div class="col">
                                    <h3 class="card-title mb-0">ប្រភេទនៃច្បាប់</h3>
                                    <p class="text-secondary m-0">Table description.</p>
                                </div>

                                <div class="col-auto">
                                    <div class="d-flex btn-list ms-auto flex-nowrap align-items-center">
                                        <div class="input-group input-group-flat">
                                            <span class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-1">
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                    <path d="M21 21l-6 -6"></path>
                                                </svg>
                                            </span>

                                            <input id="advanced-table-search" type="text" class="form-control"
                                                autocomplete="off">

                                            <span class="input-group-text">
                                                <kbd>ctrl + K</kbd>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- BEGIN MODAL -->
                                <x-popup id="modal-add" title="បន្ថែមសមាជិកថ្មី">
                                    <x-leave-types.add />
                                </x-popup>
                                <!-- END MODAL -->
                            </div>

                        </div>
                        <div id="advanced-table">
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="w-1"><input class="form-check-input m-0 align-middle"
                                                    type="checkbox" aria-label="Select all invoices"></th>
                                            <th>Name</th>
                                            <th>Name (Khmer)</th>
                                            <th>Allowed</th>
                                            <th>Counting Days</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        @foreach ($leaveTypes as $leaveType)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    aria-label="Select invoice"></td>
                                            <td>{{ $leaveType->name }}</td>
                                            <td>{{ $leaveType->name_kh }}</td>
                                            <td>{{ ucfirst($leaveType->allowed) }}</td>
                                            <td>{{ $leaveType->counting_days }}</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('leave-types.destroy', $leaveType->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this leave type?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer d-flex align-items-center">
                                <div class="dropdown">
                                    <a class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span id="page-count" class="me-1">10</span>
                                        <span>records</span>
                                    </a>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" onclick="setPageListItems(event)" data-value="10">10
                                            records</a>
                                        <a class="dropdown-item" onclick="setPageListItems(event)" data-value="20">20
                                            records</a>
                                        <a class="dropdown-item" onclick="setPageListItems(event)" data-value="50">50
                                            records</a>
                                        <a class="dropdown-item" onclick="setPageListItems(event)" data-value="100">100
                                            records</a>
                                    </div>
                                </div>
                                <ul class="pagination m-0 ms-auto">
                                    <li class="page-item active"><a class="page-link cursor-pointer" data-i="1"
                                            data-page="10">1</a></li>
                                    <li class="page-item"><a class="page-link cursor-pointer" data-i="2"
                                            data-page="10">2</a></li>
                                    <li class="page-item disabled"><a class="page-link cursor-pointer">...</a></li>
                                    <li class="page-item"><a class="page-link cursor-pointer" data-i="14"
                                            data-page="10">14</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                const advancedTable = {
                    headers: [{
                            "data-sort": "sort-name",
                            name: "Name"
                        },
                        {
                            "data-sort": "sort-email",
                            name: "Email"
                        },
                        {
                            "data-sort": "sort-status",
                            name: "Status"
                        },
                        {
                            "data-sort": "sort-date",
                            name: "Start date"
                        },
                        {
                            "data-sort": "sort-tags",
                            name: "Tags"
                        },
                        {
                            "data-sort": "sort-category",
                            name: "Category"
                        },
                    ],
                };
                const setPageListItems = (e) => {
                    window.tabler_list["advanced-table"].page = parseInt(e.target.dataset.value);
                    window.tabler_list["advanced-table"].update();
                    document.querySelector("#page-count").innerHTML = e.target.dataset.value;
                };
                window.tabler_list = window.tabler_list || {};
                document.addEventListener("DOMContentLoaded", function() {
                    const list = (window.tabler_list["advanced-table"] = new List("advanced-table", {
                        sortClass: "table-sort",
                        listClass: "table-tbody",
                        page: parseInt("20"),
                        pagination: {
                            item: (value) => {
                                return `<li class="page-item"><a class="page-link cursor-pointer">${value.page}</a></li>`;
                            },
                            innerWindow: 1,
                            outerWindow: 1,
                            left: 0,
                            right: 0,
                        },
                        valueNames: advancedTable.headers.map((header) => header["data-sort"]),
                    }));
                    const searchInput = document.querySelector("#advanced-table-search");
                    if (searchInput) {
                        searchInput.addEventListener("input", () => {
                            list.search(searchInput.value);
                        });
                    }
                });
                </script>
            </div>
        </div>
    </div>

</x-app-layout>