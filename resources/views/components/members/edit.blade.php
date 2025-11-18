<form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $member->name) }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email', $member->email) }}" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Name (Khmer)</label>
                <input type="text" class="form-control @error('name_kh') is-invalid @enderror" name="name_kh"
                    value="{{ old('name_kh', $member->name_kh) }}">
                @error('name_kh')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                    <option value="">Select gender</option>
                    <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Male
                    </option>
                    <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>Female
                    </option>
                    <option value="other" {{ old('gender', $member->gender) == 'other' ? 'selected' : '' }}>Other
                    </option>
                </select>
                @error('gender')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>


    <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"
            value="{{ old('dob', $member->dob) }}">
        @error('dob')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>


    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Position</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" name="position"
                    value="{{ old('position', $member->position) }}">
                @error('position')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone', $member->phone) }}">
                @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>


    <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="2">{{ old('address', $member->address) }}</textarea>
        @error('address')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>


    <div class="mb-3">
        <label class="form-check">
            <input type="checkbox" class="form-check-input @error('status') is-invalid @enderror" name="status"
                value="1" {{ old('status', $member->status) ? 'checked' : '' }}>
            <span class="form-check-label">Active</span>
        </label>
        @error('status')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>


    <div class="mb-3">
        <label class="form-label">Profile Image</label>

        {{-- Current image preview --}}
        @if ($member->photo)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $member->photo) }}" alt="Profile" width="80" class="rounded">
            </div>
        @endif

        <input type="file" class="form-control" name="photo">
    </div>

    <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal">Cancel</a>

        <button type="submit" class="btn btn-primary btn-5 ms-auto">
            <x-icon.edit />
            <span>Update</span>
        </button>
    </div>

</form>
