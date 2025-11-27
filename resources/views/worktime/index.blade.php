<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/style.css">
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Overview</div>
                    <h3>ម៉ោងធ្វើការ</h3>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <x-alert-messege />
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $msg)
                            <li>{{ $msg }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-6">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar avatar-lg me-2"
                                                style="background-image:url('{{ $member->photo ? asset('storage/' . $member->photo) : asset('images/non-profile.jpg') }}')">
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">{{$member->name}}</div>
                                            <div class="font-weight-medium">{{$member->name_kh}}</div>
                                            <div class="text-secondary">{{ucfirst($member->gender)}} |
                                                {{ $member->dob ? \Carbon\Carbon::parse($member->dob)->format('F d, Y') : '-' }}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 ">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">

                                        <div class="col">
                                            <div class="font-weight-medium">{{$member->phone}}</div>
                                            <div class="font-weight-medium">{{$member->position}}</div>
                                            <div class="text-secondary">
                                                @if (!empty($member->status) && $member->status)
                                                <span class="badge bg-success text-white">Active</span>
                                                @else
                                                <span class="badge bg-danger text-white">Inactive</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 mt-2">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab"
                                            aria-selected="true" role="tab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-calendar-day me-2" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.684 11.523v-2.3h2.261v-.61H4.684V6.801h2.464v-.61H4v5.332zm3.296 0h.676V8.98c0-.554.227-1.007.953-1.007.125 0 .258.004.329.015v-.613a2 2 0 0 0-.254-.02c-.582 0-.891.32-1.012.567h-.02v-.504H7.98zm2.805-5.093c0 .238.192.425.43.425a.428.428 0 1 0 0-.855.426.426 0 0 0-.43.43m.094 5.093h.672V7.418h-.672z" />
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                            </svg>ម៉ោងតាមថ្ងៃ
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab"
                                            aria-selected="false" role="tab" tabindex="-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-calendar2-month me-2"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="m2.56 12.332.54-1.602h1.984l.54 1.602h.718L4.444 7h-.696L1.85 12.332zm1.544-4.527L4.9 10.18H3.284l.8-2.375zm5.746.422h-.676v2.543c0 .652-.414 1.023-1.004 1.023-.539 0-.98-.246-.98-1.012V8.227h-.676v2.746c0 .941.606 1.425 1.453 1.425.656 0 1.043-.28 1.188-.605h.027v.539h.668zm2.258 5.046c-.563 0-.91-.304-.985-.636h-.687c.094.683.625 1.199 1.668 1.199.93 0 1.746-.527 1.746-1.578V8.227h-.649v.578h-.019c-.191-.348-.637-.64-1.195-.64-.965 0-1.64.679-1.64 1.886v.34c0 1.23.683 1.902 1.64 1.902.558 0 1.008-.293 1.172-.648h.02v.605c0 .645-.423 1.023-1.071 1.023m.008-4.53c.648 0 1.062.527 1.062 1.359v.253c0 .848-.39 1.364-1.062 1.364-.692 0-1.098-.512-1.098-1.364v-.253c0-.868.406-1.36 1.098-1.36z" />
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                                <path
                                                    d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5z" />
                                            </svg>ម៉ោងរួម

                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="tabs-home-3" role="tabpanel">
                                        <h4>ម៉ោងតាមថ្ងៃ</h4>
                                        <div>
                                            <form action="{{ route('worktimes.storeday') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="member_id" value="{{ $member->id }}">

                                                <div class="row">
                                                    @foreach($weekdays as $day)
                                                    @php
                                                    $wt = $worktimes[$day->id] ?? null;
                                                    @endphp

                                                    <div class="col-md-6 mb-3">
                                                        <div class="card">
                                                            <div
                                                                class="card-header d-flex justify-content-between align-items-center">
                                                                <strong>{{ $day->name }}</strong>

                                                                <div>
                                                                    {{-- Half day checkbox --}}
                                                                    <label class="form-check form-check-inline">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            name="days[{{ $day->id }}][half_day]"
                                                                            {{ $wt && $wt->half_day == 1 ? 'checked' : '' }}>
                                                                        <span class="form-check-label">Half day</span>
                                                                    </label>

                                                                    {{-- Work checkbox --}}
                                                                    <label class="form-check form-check-inline ms-2">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            name="days[{{ $day->id }}][work]"
                                                                            {{ $wt ? 'checked' : '' }}>
                                                                        <span class="form-check-label">Work</span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="card-body" id="card{{$day->id}}">
                                                                <div class="row mb-3">
                                                                    <div class="col-6">
                                                                        <label class="form-label">Start Time *</label>
                                                                        <input type="time" class="form-control"
                                                                            name="days[{{ $day->id }}][start_time]"
                                                                            value="{{ $wt->start_time ?? '' }}">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="form-label">End Time *</label>
                                                                        <input type="time" class="form-control"
                                                                            name="days[{{ $day->id }}][end_time]"
                                                                            value="{{ $wt->end_time ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <label class="form-label">Start Time 2</label>
                                                                        <input type="time" class="form-control"
                                                                            name="days[{{ $day->id }}][start_time2]"
                                                                            value="{{ $wt->start_time2 ?? '' }}">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="form-label">End Time 2</label>
                                                                        <input type="time" class="form-control"
                                                                            name="days[{{ $day->id }}][end_time2]"
                                                                            value="{{ $wt->end_time2 ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                @if($wt)
                                                                <input type="hidden" name="days[{{ $day->id }}][id]"
                                                                    value="{{ $wt->id }}">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>

                                                <button type="submit" class="btn btn-primary btn-5 ms-auto mt-3">
                                                    <x-icon.edit />
                                                    <span>Update</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-profile-3" role="tabpanel">
                                        <form action="{{ route('worktimes.storeall') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="member_id" value="{{ $member->id }}">

                                            @php
                                            $firstWT = $worktimes->first();
                                            $daysHave = $worktimes->keys()->toArray();
                                            @endphp

                                            <div class="row">
                                                <!-- Time Inputs -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="card">

                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center">
                                                            <strong>ម៉ោងរួម</strong>

                                                            <label class="form-check form-check-inline">
                                                                <input type="checkbox" id="half_day"
                                                                    class="form-check-input" name="half_day" value="1"
                                                                    {{ $firstWT && $firstWT->half_day == 1 ? 'checked' : '' }}>

                                                                <span class="form-check-label">Half day</span>
                                                            </label>
                                                        </div>

                                                        <div class="card-body">

                                                            <div class="row mb-3">
                                                                <div class="col-6">
                                                                    <label class="form-label">Start Time</label>
                                                                    <input type="time" name="start_time" id="start_time"
                                                                        value="{{ $firstWT->start_time ?? '' }}"
                                                                        class="form-control" required>
                                                                </div>

                                                                <div class="col-6">
                                                                    <label class="form-label">End Time</label>
                                                                    <input type="time" name="end_time" id="end_time"
                                                                        value="{{ $firstWT->end_time ?? '' }}"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <label class="form-label">Start Time 2</label>
                                                                    <input type="time" name="start_time2"
                                                                        id="start_time2"
                                                                        value="{{ $firstWT->start_time2 ?? '' }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="col-6">
                                                                    <label class="form-label">End Time 2</label>
                                                                    <input type="time" name="end_time2" id="end_time2"
                                                                        value="{{ $firstWT->end_time2 ?? '' }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Weekday Checkbox -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6>ជ្រើសរើសថ្ងៃ</h6>
                                                            <hr>

                                                            <div class="row">
                                                                @foreach ($weekdays as $day)
                                                                <div class="col-md-3 mb-2">
                                                                    <label class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="day[]" value="{{ $day->id }}"
                                                                            {{ in_array($day->id, $daysHave) ? 'checked' : '' }}>
                                                                        <span class="form-check-label">
                                                                            {{ $day->name_kh }}
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-primary btn-5 ms-auto mt-3">
                                                <x-icon.edit />
                                                <span>Update</span>
                                            </button>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- 
    @foreach ($worktimes as $worktime)
    {{ $worktime }}
    @endforeach -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        function toggleHalfDay() {
            let half = document.getElementById("half_day").checked;
            document.getElementById("start_time2").disabled = half;
            document.getElementById("end_time2").disabled = half;

            if (half) {
                document.getElementById("start_time2").value = "";
                document.getElementById("end_time2").value = "";
            }
        }

        document.getElementById("half_day").addEventListener("change", toggleHalfDay);
        toggleHalfDay();
    });
    </script>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("input[name*='half_day']").forEach(checkbox => {

            checkbox.addEventListener("change", function() {
                toggleAfternoon(this);
            });
            toggleAfternoon(checkbox);
        });
        document.querySelectorAll("input[name*='[work]']").forEach(checkbox => {

            checkbox.addEventListener("change", function() {
                toggleWork(this);
            });

            // run once on page load
            toggleWork(checkbox);
        });


        function toggleAfternoon(checkbox) {

            // match number weekId inside: days[3][half_day]
            const match = checkbox.name.match(/\[(\d+)\]/);

            if (!match) {
                console.warn("Invalid half_day name:", checkbox.name);
                return;
            }

            const weekId = match[1];

            const start2 = document.querySelector(
                `input[name='days[${weekId}][start_time2]']`
            );
            const end2 = document.querySelector(
                `input[name='days[${weekId}][end_time2]']`
            );

            if (!start2 || !end2) return;

            // parent .col-6
            const startCol = start2.closest(".col-6");
            const endCol = end2.closest(".col-6");

            if (checkbox.checked) {
                startCol.style.display = "none";
                endCol.style.display = "none";

            } else {
                startCol.style.display = "block";
                endCol.style.display = "block";
            }
        }

        function toggleWork(checkbox) {

            const match = checkbox.name.match(/\[(\d+)\]/);

            if (!match) {
                console.warn("Invalid work name:", checkbox.name);
                return;
            }

            const weekId = match[1];
            const card = document.getElementById(`card${weekId}`);

            if (!checkbox.checked) {
                card.style.display = "none";
            } else {
                card.style.display = "block";
            }

        }

    });
    </script>



</x-app-layout>