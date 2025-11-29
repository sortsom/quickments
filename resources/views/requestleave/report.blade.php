<x-app-layout>
    <div class="container mt-5">

        <!-- Header + Print -->
        <div class="d-flex justify-content-between align-items-center mb-3 no-print">
            <h3 class="m-0">របាយការណ៍សុំច្បាប់</h3>

        </div>

        <!-- FILTER FORM -->
        <form method="GET" action="{{ route('requestleave.report') }}" class="row g-2 mb-4 align-items-end no-print">

            <div class="col-auto">
                <label class="form-label mb-0">Member</label>
                <select name="member" class="form-control">
                    <option value="">All Members</option>
                    @foreach ($members as $m)
                        <option value="{{ $m->id }}" {{ request('member') == $m->id ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <label class="form-label mb-0">From</label>
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
            </div>

            <div class="col-auto">
                <label class="form-label mb-0">To</label>
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
            </div>

            <div class="col-auto">
                <button class="btn btn-success text-white">Apply Filter</button>
                <a href="{{ route('requestleave.report') }}" class="btn btn-outline-success ms-1">
                    Reset
                </a>
                <button onclick="window.print()" class="btn btn-danger">
                    Print Report
                </button>
            </div>

        </form>

        <!-- SHOW TABLE ONLY AFTER APPLY FILTER -->
        <!-- SHOW TABLE ONLY AFTER APPLY FILTER -->
        @if (request()->filled('member') || request()->filled('from') || request()->filled('to'))
            <!-- COMPANY / USER INFO -->
            <div class="mb-3">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" height="30" width="120px;">

                <div class="mt-2">
                    <strong>User:</strong> {{ auth()->user()->name }} <br>
                    <strong>Start Date:</strong> {{ request('from') ?: '-' }} <br>
                    <strong>End Date:</strong> {{ request('to') ?: '-' }}
                </div>
            </div>


            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-bordered table-sm m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Member</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Approver</th>
                                <th>Requested At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->user->name ?? '-' }}</td>
                                    <td>{{ $r->member->name ?? '-' }}</td>
                                    <td>{{ $r->typeLeave->name ?? '-' }}</td>
                                    <td>{{ $r->status->name ?? '-' }}</td>
                                    <td>{{ $r->approver->name ?? '-' }}</td>
                                    <td>{{ optional($r->created_at)->format('Y-m-d') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                Please click <strong>Apply Filter</strong> to view report data.
            </div>
        @endif


    </div>

    <!-- PRINT STYLE -->
    <style>
        @media print {

            /* Remove browser header/footer */
            @page {
                margin: 0 !important;
                size: auto;
            }

            body {
                margin: 2mm !important;
            }

            /* Hide interactive elements */
            .no-print {
                display: none !important;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }

            table th,
            table td {
                border: 1px solid #000 !important;
                padding: 5px !important;
            }
        }
    </style>

</x-app-layout>
