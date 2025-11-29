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
                                        <span class="bg-primary text-white avatar">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <x-icon.sign />
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium" id="khmer">កត់ត្រាវត្តមាន</div>
                                        <div class="text-secondary">{{$attendance}} Users/today</div>
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
                                        <span class="bg-green text-white avatar">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/shopping-cart -->
                                            <x-icon.prochese />
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium" id="khmer">សុំច្បាប់</div>
                                        <div class="text-secondary">{{$requestleave}} / នាក់</div>
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
                                        <div class="font-weight-medium" id="khmer">អ្នកប្រើប្រាស់</div>
                                        <div class="text-secondary">{{$users}} / user</div>
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
                                        <span class="bg-facebook text-white avatar">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/brand-facebook -->
                                            <x-icon.user />
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium" id="khmer">សមាជិក</div>
                                        <div class="text-secondary">{{$activeMembers}} / នាក់</div>
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

                    <div class="table-responsive">
                        <table class="table table-selectable card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>

                                    <th>ល.រ</th>
                                    <th>ឈ្មោះ</th>
                                    <th>ម៉ោងចូល ពេលព្រឹក</th>
                                    <th>ម៉ោងចេញ ពេលព្រឹក</th>
                                    <th>ម៉ោងចូល ពេលរសៀល</th>
                                    <th>ម៉ោងចេញ ពេលរសៀល</th>
                                </tr>
                            </thead>
                            @php
                            function checkStatus($actual, $standard, $type) {
                            if (!$actual) return '';

                            if ($type === 'in') {
                            return $actual > $standard ? 'Late' : 'Good';
                            } else {
                            return $actual < $standard ? 'Early' : 'Good' ; } } $statusColor=[ 'good'=> 'bg-success-lt',
                                'late' => 'bg-danger-lt',
                                'early' => 'bg-primary-lt',
                                ]; @endphp <tbody>

                                    @foreach($data as $item)
                                    @php $morningIn=$item->details->firstWhere('check_type', 1);
                                    $morningOut = $item->details->firstWhere('check_type', 2);
                                    $afternoonIn = $item->details->firstWhere('check_type', 3);
                                    $afternoonOut = $item->details->firstWhere('check_type', 4);

                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->member->name }}</td>

                                        <td>
                                            {{ $morningIn->clock ?? '' }}
                                            <span
                                                class="badge {{ $statusColor[strtolower(checkStatus($morningIn->clock ?? null,$item->start_time , 'in') ?? '')] ?? ''}}">
                                                {{checkStatus($morningIn->clock ?? null,$item->start_time , 'in') }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $morningOut->clock ?? '' }}
                                            <span
                                                class="badge {{ $statusColor[strtolower(checkStatus($morningOut->clock ?? null,$item->end_time , 'in') ?? '')] ?? ''}}">
                                                {{checkStatus($morningOut->clock ?? null,$item->end_time , 'in') }}
                                            </span>

                                        </td>
                                        <td>
                                            {{ $afternoonIn->clock ?? '' }}
                                            <span
                                                class="badge {{ $statusColor[strtolower(checkStatus($afternoonIn->clock ?? null,$item->start_time2 , 'in') ?? '')] ?? ''}}">
                                                {{checkStatus($afternoonIn->clock ?? null,$item->start_time2 , 'in') }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $afternoonOut->clock ?? '' }}
                                            <span
                                                class="badge {{ $statusColor[strtolower(checkStatus($afternoonOut->clock ?? null,$item->end_time2 , 'in') ?? '')] ?? ''}}">
                                                {{checkStatus($afternoonOut->clock ?? null,$item->end_time2 , 'in') }}
                                            </span>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                    <div class="card-footer">

                        <div class="row g-2 justify-content-center justify-content-sm-between">
                            <div class="col-auto d-flex align-items-center">
                                <p class="m-0 text-secondary">
                                    Showing <strong>{{ $data->firstItem() }}</strong>
                                    to <strong>{{ $data->lastItem() }}</strong>
                                    of <strong>{{ $data->total() }}</strong> entries
                                </p>
                            </div>
                            <div class="col-auto">
                                <ul class="pagination m-0 ms-auto">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-left -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                <path d="M15 6l-6 6l6 6"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    {{-- Page Numbers --}}
                                    @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                    @endforeach
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-right -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
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
    {{-- <!--  BEGIN FOOTER  -->
    <x-footer />
    <!--  END FOOTER  --> --}}
</x-app-layout>