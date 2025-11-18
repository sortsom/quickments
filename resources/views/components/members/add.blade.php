<form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Your name" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="Your email" required>
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
                    placeholder="ឈ្មោះខ្មែរ">
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
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>


    <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob">
        @error('dob')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Position</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" name="position"
                    placeholder="Position">
                @error('position')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    placeholder="Phone number">
                @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>


    <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address"
            rows="2"></textarea>
        @error('address')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-check">
            <input type="checkbox" class="form-check-input @error('status') is-invalid @enderror" name="status"
                value="1">
            <span class="form-check-label">Active</span>
        </label>
        @error('status')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Profile Image</label>
        <input type="file" class="form-control" name="photo">
    </div>


    <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal"> Cancel
        </a>
        <button type="submit" class="btn btn-primary btn-5 ms-auto">
            <x-icon.plus />
            <span>បង្កើតថ្មី</span>
        </button>
    </div>
</form>
