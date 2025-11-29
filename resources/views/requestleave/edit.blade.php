<x-app-layout>
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
    <div class="container mt-5">
        <form action="{{ route('requestleave.update', $requests->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-6">
                    {{-- Member --}}
                    <div class="mb-3">
                        <label class="form-label">ឈ្មោះ</label>
                        <select id="memberSelect" name="member_id" class="form-select" required>
                            <option value="">-- Select Member --</option>
                            @foreach ($members as $member)
                            <option value="{{ $member->id }}" data-gender="{{ strtolower($member->gender) }}"
                                {{ old('member_id', $requests->member_id) == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('member_id')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    {{-- Date --}}
                    <div class="mb-3">
                        <label class="form-label">ចំនួនថ្ងៃសម្រាក</label>
                        <input type="number" name="date" class="form-control @error('date') is-invalid @enderror"
                            value="{{ old('date', $requests->date) }}" required>
                        @error('date')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Start Date --}}
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">ថ្ងៃចាប់ផ្តើម</label>
                        <input type="date" name="start_time"
                            class="form-control @error('start_time') is-invalid @enderror"
                            value="{{ old('start_time', \Carbon\Carbon::parse($requests->start_time)->format('Y-m-d')) }}">
                        @error('start_time')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- End Date --}}
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">ថ្ងៃបញ្ចប់</label>
                        <input type="date" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                            value="{{ old('end_time', \Carbon\Carbon::parse($requests->end_time)->format('Y-m-d')) }}">
                        @error('end_time')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Leave Type --}}
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">ប្រភេទនៃច្បាប់</label>
                        <select id="leaveTypeSelect" name="type_leave" class="form-select" required>
                            <option value="">-- Select Leave Type --</option>
                            @foreach ($leavetypes as $type)
                            <option value="{{ $type->id }}" data-allowed="{{ strtolower($type->allowed) }}"
                                {{ old('type_leave', $requests->type_leave) == $type->id ? 'selected' : '' }}>
                                {{ $type->name_kh }}
                            </option>
                            @endforeach
                        </select>
                        <small id="leaveTypeMessage" class="text-danger d-none">
                            ខ្លួនឯងប្រុស​ ដាក់ច្បាប់ពោះធំមិនកើតទេ
                        </small>
                        @error('type_leave')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Type --}}
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">ប្រភេទសម្រាក</label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="full_day" {{ old('type', $requests->type) == 'full_day' ? 'selected' : '' }}>
                                Full Day</option>
                            <option value="half_day_morning"
                                {{ old('type', $requests->type) == 'half_day_morning' ? 'selected' : '' }}>Half Day
                                Morning</option>
                            <option value="half_day_afternoon"
                                {{ old('type', $requests->type) == 'half_day_afternoon' ? 'selected' : '' }}>Half Day
                                Afternoon</option>
                        </select>
                        @error('type')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Reason --}}
            <div class="mb-3">
                <label class="form-label">មូលហេតុសុំបែប Professional??</label>
                <textarea name="reason" class="form-control @error('reason') is-invalid @enderror"
                    rows="3">{{ old('reason', $requests->reason) }}</textarea>
                @error('reason')
                <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Photo --}}
            <div class="mb-3">
                <label class="form-label">រូបភាព</label>
                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">

                @if ($requests->photo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $requests->photo) }}"
                        style="max-width: 150px; max-height: 150px; object-fit: cover; border-radius: 6px;">
                </div>
                @endif

                @error('photo')
                <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-5 ms-auto">
                <x-icon.edit />
                <span>កែប្រែ</span>
            </button>
        </form>


    </div>

</x-app-layout>