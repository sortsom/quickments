    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <form action="{{ route('requestleave.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-6">


                <div class="mb-3">
                    <div class="form-label">Member</div>
                    <select class="form-select">
                        <option value="">-- Select Member --</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Member</label>
                    <select name="member_id" class="form-control @error('member_id') is-invalid @enderror" required>
                        <option value="">-- Select Member --</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                    @error('member_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div> --}}
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                        required>
                    @error('date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="start_time"
                        class="form-control @error('start_time') is-invalid @enderror" required>
                    @error('start_time')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                        required>
                    @error('end_time')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <div class="form-label">ប្រភេទនៃច្បាប់</div>
                    <select class="form-select">
                        <option value="">-- Select ប្រភេទច្បាប់ --</option>
                        @foreach ($leavetypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name_kh }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label">ប្រភេទនៃច្បាប់</label>
                    <select name="member_id" class="form-control @error('type') is-invalid @enderror" required>
                        <option value="">-- Select ប្រភេទច្បាប់ --</option>
                        @foreach ($leavetypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name_kh }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div> --}}
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Leave Type</label>
                    <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                        <option value="full_day">Full Day</option>
                        <option value="half_day_morning">Half Day Morning</option>
                        <option value="half_day_afternoon">Half Day Afternoon</option>
                    </select>
                    @error('type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>




        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" required>
            @error('photo')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary btn-5 ms-auto">
            <x-icon.plus />
            <span>រក្សាទុក</span>
        </button>
    </form>
