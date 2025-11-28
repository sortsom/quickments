<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">

        {{-- Select Member --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">ឈ្មោះបុគ្គលិក</label>
            <select id="select-tags" name="member_id">
                @foreach($members as $member)
                <option value="{{ $member->id }}">
                    {{ $member->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Role --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Role</label>
            <select class="form-control" name="role_name">
                <option value="staff" selected>Staff</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        {{-- Name --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" placeholder="Your name" required
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" placeholder="Your email" required
                class="form-control @error('email') is-invalid @enderror">
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" placeholder="Password" required
                class="form-control @error('password') is-invalid @enderror">
            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Profile Image --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Profile Image</label>
            <input type="file" name="photo" class="form-control">
        </div>

    </div>

    <div class="modal-footer">
        <a href="#" class="btn btn-secondary btn-3" data-bs-dismiss="modal">Cancel</a>

        <button type="submit" class="btn btn-primary btn-5 ms-auto">
            <x-icon.plus />
            <span>បង្កើតថ្មី</span>
        </button>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var el = document.getElementById("select-tags");

    if (window.TomSelect && el) {
        new TomSelect(el, {
            plugins: ['remove_button'],
            create: false,
        });
    }
});
</script>