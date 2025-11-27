<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/style.css">
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Overview</div>
                    <h3>ធ្វើការថែមម៉ោង</h3>
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
                    <!-- BEGIN MODAL -->
                    <x-popup id="modal-add" title="ស្មើរធ្វើការថែមម៉ោង">
                        <x-overtime.add />

                    </x-popup>
                    <!-- END MODAL -->
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
                    <div class="card-table">
                        <div class="card-header">
                            <div class="row w-full align-items-center">
                                <div class="col">
                                    <h3 class="card-title mb-0">ស្មើរធ្វើការថែមម៉ោង</h3>
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
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0">
                                                    </path>
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
                            </div>

                        </div>
                        <div id="advanced-table">
                            <div class="table-responsive">
                                <table class="table-vcenter table-selectable table">
                                    <thead>
                                        <tr>
                                            <th class="w-1"></th>
                                            <th>
                                                <button class="table-sort d-flex justify-content-between"
                                                    data-sort="sort-name">Name</button>
                                            </th>
                                            <th>
                                                <button class="table-sort d-flex justify-content-between"
                                                    data-sort="sort-name-kh">Name (Khmer)</button>
                                            </th>
                                            <th>
                                                <button class="table-sort d-flex justify-content-between"
                                                    data-sort="sort-email">Email</button>
                                            </th>
                                            <th>
                                                <button class="table-sort d-flex justify-content-between"
                                                    data-sort="sort-gender">Gender</button>
                                            </th>
                                            <th>
                                                <button class="table-sort d-flex justify-content-between"
                                                    data-sort="sort-dob">DOB</button>
                                            </th>
                                            <th>
                                                <button class="table-sort d-flex justify-content-between"
                                                    data-sort="sort-position">Position</button>
                                            </th>
                                            <th>
                                                <button class="table-sort d-flex justify-content-between"
                                                    data-sort="sort-phone">Phone</button>
                                            </th>
                                            <th>
                                                <button class="table-sort d-flex justify-content-between"
                                                    data-sort="sort-status">Status</button>
                                            </th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        {{-- @forelse($members as $member)
                                            <tr>
                                                <td>
                                                    <input
                                                        class="form-check-input table-selectable-check m-0 align-middle"
                                                        type="checkbox" aria-label="Select member"
                                                        value="{{ $member->id }}">
                                                </td>
                                                <td class="sort-name">
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-lg me-2"
                                                            style="background-image:url('{{ $member->photo ? asset('storage/' . $member->photo) : asset('images/non-profile.jpg') }}')">
                                                        </span>

                                                        <div class="d-flex align-items-center">
                                                            <span>{{ $member->name }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="sort-name-kh">{{ $member->name_kh }}</td>
                                                <td class="sort-email">{{ $member->email }}</td>
                                                <td class="sort-gender">
                                                    {{ $member->gender ? ucfirst($member->gender) : '-' }}</td>
                                                <td class="sort-dob">
                                                    {{ $member->dob ? \Carbon\Carbon::parse($member->dob)->format('F d, Y') : '-' }}
                                                </td>
                                                <td class="sort-position">{{ $member->position ?? '-' }}</td>
                                                <td class="sort-phone">{{ $member->phone ?? '-' }}</td>
                                                <td class="sort-status">
                                                    @if (!empty($member->status) && $member->status)
                                                        <span class="badge bg-success text-white">Active</span>
                                                    @else
                                                        <span class="badge bg-danger text-white">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-1 btn-icon bg-info text-white"
                                                        aria-label="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#edit-{{ $member->id }}">
                                                        <x-icon.edit />
                                                    </a>

                                                    <form action="{{ route('members.destroy', $member) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Delete this member?');"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-1 btn-icon bg-danger text-white"
                                                            aria-label="Delete">
                                                            <x-icon.trash />
                                                        </button>
                                                    </form>
                                                </td>
                                                <x-popup id="edit-{{ $member->id }}" title="កែសម្រួលសមាជិក">
                                                    <x-members.edit :member="$member" />
                                                </x-popup>
                                                <!-- EDIT MODAL -->
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center py-4">No members found.</td>
                                            </tr>
                                        @endforelse --}}
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
