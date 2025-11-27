<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                    <!-- BEGIN MODAL -->
                    <x-popup id="modal-add" title="ស្មើរសុំច្បាប់ថ្មី">
                        <x-requestleave.add :members="$members" :leavetypes="$leavetypes" />

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
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member</th>
                            <th>Date</th>
                            <th>Start-Date</th>
                            <th>End-Date</th>
                            <th>Leave Type</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Approved By</th>
                            <th>Approved Date</th>
                            <th>Updated</th>

                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->member->name ?? '-' }}</td>
                                <td>{{ $request->date }}</td>
                                <td>{{ $request->start_time->format('d.m.Y') }}</td>
                                <td>{{ $request->end_time->format('d.m.Y') }}</td>
                                <td>{{ $request->typeLeave->name_kh ?? ($request->typeLeave->name ?? '-') }}</td>
                                <td>{{ $request->type }}</td>
                                <td>
                                    @php
                                        $name = $request->status->name ?? 'Pending';

                                        $color = match ($name) {
                                            'Pending' => 'bg-yellow',
                                            'Reject' => 'bg-red',
                                            'Approve' => 'bg-green',
                                            'Cancel' => 'bg-gray',
                                            default => 'bg-secondary',
                                        };
                                    @endphp

                                    <span class="badge {{ $color }} text-white">{{ $name }}</span>
                                    <span class="badge bg-green text-white">approve</span>

                                </td>

                                <td>{{ $request->user_id->name ?? '-' }}</td>
                                <td>{{ $request->approve_date }}</td>
                                <td>
                                    <a href="{{ route('requestleave.edit', $request->id) }}" class="text-blue me-2">
                                        <x-edit />
                                    </a>
                                    <a href="{{ route('requestleave.destroy', $request->id) }}" class="text-red"
                                        onclick="return confirm('Are you sure?')">
                                        <x-trash />
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No leave requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>



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
