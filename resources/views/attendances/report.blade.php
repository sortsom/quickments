<x-app-layout>
    <style>
        /* Hide elements you don't want to print */
        @media print {
            .no-print {
                display: none !important;
            }

            /* Improve table density for print */
            table {
                font-size: 12px;
            }
        }
    </style>

    <div class="container mt-5">
        <h3 class="no-print">របាយការណ៍អវត្តមាន</h3>

        <form id="reportForm" method="GET" action="{{ route('attendance.report') }}"
            class="row g-2 mb-3 align-items-center no-print">
            {{-- Member selector: dropdown for admin/owner (multiple members),
             otherwise plain text + hidden input for staff (single member). --}}
            <div class="col-auto">
                @if ($members->count() > 1)
                    <select name="member" class="form-select">
                        <option value="">-- All members --</option>
                        @foreach ($members as $m)
                            <option value="{{ $m->id }}"
                                @php
$sel = isset($filter['member']) ? $filter['member'] : request('member'); @endphp
                                @if ($sel == $m->id) selected @endif>
                                {{ $m->name }}
                            </option>
                        @endforeach
                    </select>
                @elseif($members->count() === 1)
                    @php $single = $members->first(); @endphp
                    <div class="form-control-plaintext bg-danger rounded-2 p-2 text-white"
                        style="padding-top: .375rem; padding-bottom: .375rem;">
                        {{ $single->name }}
                        <div><small class="text-white">You can only view your own data</small></div>
                    </div>
                    <input type="hidden" name="member" value="{{ $single->id }}">
                @else
                    <select name="member" class="form-select">
                        <option value="">-- No members --</option>
                    </select>
                @endif
            </div>

            <div class="col-auto">
                <input type="date" name="from" class="form-control"
                    value="{{ isset($filter['from']) ? $filter['from'] : request('from') }}">
            </div>

            <div class="col-auto">
                <input type="date" name="to" class="form-control"
                    value="{{ isset($filter['to']) ? $filter['to'] : request('to') }}">
            </div>

            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>

            {{-- Print button (no form submit) --}}
            <div class="col-auto">
                <button type="button" class="btn btn-danger" onclick="printReport()">
                    Print
                </button>
            </div>
        </form>

        <div id="printableReport">
            {{-- ===================== Summary Always Show ===================== --}}
            <h5>Summary</h5>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Total Days</th>
                        <th>Present Days</th>
                        <th>Total Late (mins)</th>
                        <th>Total Early (mins)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($summary as $s)
                        <tr>
                            <td>{{ $s['member_name'] }}</td>
                            <td>{{ $s['total_days'] }}</td>
                            <td>{{ $s['present_days'] }}</td>
                            <td>{{ $s['total_late'] }}</td>
                            <td>{{ $s['total_early'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ===================== DETAILS only when filter applied ===================== --}}
            @if (request('member') || request('from') || request('to'))
                <h5>Details</h5>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Member</th>
                            <th>Present</th>
                            <th>Late (mins)</th>
                            <th>Early (mins)</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $r)
                            <tr>
                                <td>{{ $r['date'] }}</td>
                                <td>{{ $r['member_name'] }}</td>
                                <td>{{ $r['present'] ? 'Yes' : 'No' }}</td>
                                <td>{{ $r['late_minutes'] }}</td>
                                <td>{{ $r['early_minutes'] }}</td>
                                <td>
                                    @foreach ($r['details'] as $d)
                                        <div>
                                            Type: {{ $d['check_type'] }} — {{ $d['clock'] }} — {{ $d['status'] }}
                                            @if ($d['count_time'])
                                                ({{ $d['count_time'] }} min)
                                            @endif
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Auto-submit for staff (when only one member). This avoids needing the staff to click Filter. --}}
    @if ($members->count() === 1 && !(request('member') || request('from') || request('to')))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // add a short delay so markup finishes rendering (safe UX)
                setTimeout(function() {
                    document.getElementById('reportForm').submit();
                }, 150);
            });
        </script>
    @endif

    <script>
        function printReport() {
            // simple print using CSS to hide non-printable elements
            window.print();
        }
    </script>
</x-app-layout>
