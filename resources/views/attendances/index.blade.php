<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .markdown>table thead th,
    .table thead th {
        font-size: 11pt;
    }
    </style>


    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <!-- <div class="page-pretitle">កត់ត្រាវត្តមាន</div> -->
                    <h3>កត់ត្រាវត្តមាន</h3>
                </div>
                @if (in_array(Auth::user()->role->role, ['owner','admin']))
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
                    <x-popup id="modal-add" title="បង្កើតថ្មី">
                        <x-attendances.add :members="$members" />
                    </x-popup>
                    <!-- END MODAL -->

                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">

                <div class="card">




                    <x-alert-messege />




                    <div class="card-table">
                        <div class="card-header">
                            <div class="row w-full align-items-center">
                                <div class="col">

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
                            </div>

                        </div>
                        <div id="advanced-table">
                            <div class="table-responsive">
                                <table class="table-vcenter table-selectable table">
                                    <thead>
                                        <tr>
                                            <th class="w-1">#</th>
                                            <th class="text-center">
                                                ព័ត៌មានបុគ្គលិក
                                            </th>
                                            <th class="text-center">
                                                កាលបរិច្ឆេទ
                                            </th>
                                            <th class="text-center">
                                                ម៉ោងចូល
                                            </th>
                                            <th class="text-center">
                                                ម៉ោងចេញ
                                            </th>
                                            <th class="text-center">
                                                ម៉ោងចូល
                                            </th>
                                            <th class="text-center">
                                                ម៉ោងចេញ
                                            </th>
                                            <th class="text-center">
                                                ហេតុផល
                                            </th>
                                            @if (in_array(Auth::user()->role->role, ['owner','admin']))
                                            <th class="text-end">ផ្សេងៗ</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">

                                        @foreach($data as $att)

                                        @php
                                        $detail = [
                                        'morning_in' => $att->details->where('check_type',1)->first(),
                                        'morning_out' => $att->details->where('check_type',2)->first(),
                                        'afternoon_in' => $att->details->where('check_type',3)->first(),
                                        'afternoon_out' => $att->details->where('check_type',4)->first(),
                                        ];

                                        $mi = $detail['morning_in'];
                                        $mo = $detail['morning_out'];
                                        $ai = $detail['afternoon_in'];
                                        $ao = $detail['afternoon_out'];

                                        $statusColor = [
                                        'good' => 'bg-success-lt',
                                        'late' => 'bg-danger-lt',
                                        'early' => 'bg-primary-lt',
                                        ];


                                        @endphp


                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>

                                            {{-- Employee Info --}}
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <img src="{{ asset('storage/' . $att->member->photo) }}"
                                                        class="img-circle avatar avatar-2 me-2"
                                                        style="width:45px;height:45px">
                                                    <div class="flex-fill">
                                                        <div class="font-weight-medium">{{ $att->member->name }}</div>
                                                        <div class="text-secondary">
                                                            <span
                                                                class="description">{{ ucfirst($att->member->gender) }}</span><br>
                                                            <span
                                                                class="description">{{ $att->member->position }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Date --}}
                                            <td>{{ $att->date }}</td>

                                            {{-- Morning In --}}
                                            <td>
                                                <p>
                                                    {{ $mi->clock ?? '---' }}
                                                    <span
                                                        class="badge {{ $statusColor[strtolower($mi->status ?? '')] ?? 'bg-secondary-lt'}}">
                                                        {{ $mi->status ?? '---' }}
                                                    </span>
                                                </p>
                                                <p class="text-secondary">Time: {{ $att->start_time }}</p>
                                            </td>

                                            {{-- Morning Out --}}
                                            <td>
                                                <p>
                                                    {{ $mo->clock ?? '---' }}
                                                    <span
                                                        class="badge {{$statusColor[strtolower($mo->status ?? '')] ?? 'bg-secondary-lt'}}">
                                                        {{ $mo->status ?? '---' }}
                                                    </span>
                                                </p>
                                                <p class="text-secondary">Time: {{ $att->end_time }}</p>
                                            </td>

                                            {{-- Afternoon --}}
                                            @if ($att->details->count() > 2)

                                            <td>
                                                <p>
                                                    {{ $ai->clock ?? '---' }}
                                                    <span
                                                        class="badge {{$statusColor[strtolower($ai->status ?? '')] ?? 'bg-secondary-lt'}}">
                                                        {{ $ai->status ?? '---' }}
                                                    </span>
                                                </p>
                                                <p class="text-secondary">Time: {{ $att->start_time2 }}</p>
                                            </td>

                                            <td>
                                                <p>
                                                    {{ $ao->clock ?? '---' }}
                                                    <span
                                                        class="badge {{ $statusColor[strtolower($ao->status ?? '')] ?? 'bg-secondary-lt' }}">
                                                        {{ $ao->status ?? '---' }}
                                                    </span>
                                                </p>
                                                <p class="text-secondary">Time: {{ $att->end_time2 }}</p>
                                            </td>
                                            @else

                                            <td colspan="2">
                                                <p class="text-secondary">No Work</p>
                                            </td>

                                            @endif
                                            {{-- Reason --}}
                                            <td class="text-secondary">
                                                {{ $mi->reason ?? $mo->reason ?? $ai->reason ?? $ao->reason ?? '' }}
                                            </td>
                                            @if (in_array(Auth::user()->role->role, ['owner','admin']))
                                            <td class="text-end">

                                                <!-- Edit Button -->
                                                <a href="#" class="btn btn-1 btn-icon bg-info text-white"
                                                    aria-label="Edit" data-bs-toggle="modal"
                                                    data-bs-target="#edit-{{ $att->id }}">
                                                    <x-icon.edit />
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('attendance.destroy', $att->id) }}" method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-1 btn-icon bg-danger text-white"
                                                        aria-label="Delete">
                                                        <x-icon.trash />
                                                    </button>
                                                </form>
                                            </td>
                                            @endif

                                        </tr>
                                        <!-- BEGIN EDIT MODAL -->
                                        <x-popup id="edit-{{ $att->id }}" title="កែប្រែវត្តមាន">
                                            <x-attendances.edit :members="$members" :att="$att" />
                                        </x-popup>
                                        <!-- END EDIT MODAL -->
                                        @endforeach

                                    </tbody>


                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                <div class="dropdown">
                                    <a class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span id="page-count" class="me-1">5</span>
                                        <span>records</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="setPageListItems(event)" data-value="5">5
                                            records</a>
                                        <a class="dropdown-item" onclick="setPageListItems(event)" data-value="10">10
                                            records</a>
                                        <a class="dropdown-item" onclick="setPageListItems(event)" data-value="20">20
                                            records</a>
                                        <a class="dropdown-item" onclick="setPageListItems(event)" data-value="50">50
                                            records</a>
                                    </div>
                                </div>
                                <ul class="pagination m-0 ms-auto">
                                    <li class="page-item active"><a class="page-link cursor-pointer" data-i="1"
                                            data-page="5">1</a></li>
                                    <li class="page-item"><a class="page-link cursor-pointer" data-i="2"
                                            data-page="5">2</a></li>
                                    <li class="page-item disabled"><a class="page-link cursor-pointer">...</a></li>
                                    <li class="page-item"><a class="page-link cursor-pointer" data-i="14"
                                            data-page="5">14</a></li>
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
                    }, ],
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
                        page: parseInt("5"),
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