<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@props(['members', 'leavetypes'])
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const memberSelect = document.getElementById('memberSelect');
        const leaveTypeSelect = document.getElementById('leaveTypeSelect');
        const warningMsg = document.getElementById('leaveTypeMessage');

        function validateLeaveType() {
            const memberGender = memberSelect.options[memberSelect.selectedIndex]?.dataset.gender;
            const allowed = leaveTypeSelect.options[leaveTypeSelect.selectedIndex]?.dataset.allowed;

            if (!memberGender || !allowed) {
                warningMsg.classList.add('d-none');
                return;
            }

            if (allowed === 'all' || allowed === memberGender) {
                warningMsg.classList.add('d-none');
            } else {
                warningMsg.classList.remove('d-none');
            }
        }

        memberSelect.addEventListener('change', validateLeaveType);
        leaveTypeSelect.addEventListener('change', validateLeaveType);
    });
</script>

<form action="{{ route('requestleave.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-6">
            {{-- Member --}}
            <div class="mb-3">
                <label class="form-label">Member</label>
                <select id="memberSelect" name="member_id" class="form-select" required>
                    <option value="">-- Select Member --</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" data-gender="{{ strtolower($member->gender) }}">
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>

                @error('member_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            {{-- Date --}}
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="number" name="date" class="form-control @error('date') is-invalid @enderror"
                    value="{{ old('date') }}" required>
                @error('date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Start Date --}}
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_time" class="form-control @error('start_time') is-invalid @enderror"
                    value="{{ old('start_time') }}">
                @error('start_time')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- End Date --}}
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                    value="{{ old('end_time') }}">
                @error('end_time')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Type Leave (FK type_leave) --}}
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">ប្រភេទនៃច្បាប់</label>
                <div class="mb-3">

                    <select id="leaveTypeSelect" name="type_leave" class="form-select" required>
                        <option value="">-- Select Leave Type --</option>
                        @foreach ($leavetypes as $type)
                            <option value="{{ $type->id }}" data-allowed="{{ strtolower($type->allowed) }}">
                                {{ $type->name_kh }}
                            </option>
                        @endforeach
                    </select>

                    <small id="leaveTypeMessage" class="text-danger d-none">
                        ខ្លួនឯងប្រុស ដាក់ច្បាប់ពោះធំមិនកើតទេពៅមាស
                    </small>
                </div>

                @error('type_leave')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Type --}}
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Leave Type</label>
                <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                    <option value="full_day" {{ old('type') == 'full_day' ? 'selected' : '' }}>Full Day</option>
                    <option value="half_day_morning" {{ old('type') == 'half_day_morning' ? 'selected' : '' }}>Half Day
                        Morning</option>
                    <option value="half_day_afternoon" {{ old('type') == 'half_day_afternoon' ? 'selected' : '' }}>Half
                        Day Afternoon</option>
                </select>
                @error('type')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    {{-- Reason --}}
    <div class="mb-3">
        <label class="form-label">Reason</label>
        <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" rows="3">{{ old('reason') }}</textarea>
        @error('reason')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    {{-- Photo --}}
    <div class="mb-3">
        <label class="form-label">Photo</label>
        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
        @error('photo')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary btn-5 ms-auto">
        <x-icon.plus />
        <span>រក្សាទុក</span>
    </button>
</form>
