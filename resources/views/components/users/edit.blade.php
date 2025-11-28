<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

<form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row">

        <!-- MEMBER -->
        <div class="col-md-6 mb-3">
            <label class="form-label">ឈ្មោះបុគ្គលិក</label>

            <select id="select-tags" name="member_id" class="form-control">
                <option value="">-- Select Member --</option>
                @foreach($members as $member)
                <option value="{{ $member->id }}" {{ $user->member_id == $member->id ? 'selected' : '' }}>
                    {{ $member->name }}
                </option>
                @endforeach
            </select>
        </div>
        

        <!-- ROLE -->
        <div class="col-md-6 mb-3">
            <label class="form-label">សិទ្ធិអ្នកប្រើប្រាស់</label>
            <select class="form-control" name="role_name">
                <option value="staff" {{ $user->role->role === 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="admin" {{ $user->role->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ $user->role->role === 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
        </div>

        <!-- NAME -->
        <div class="col-md-6 mb-3">
            <label class="form-label">ឈ្មោះអ្នកប្រើប្រាស់</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name', $user->name) }}" required>
            @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- EMAIL -->
        <div class="col-md-6 mb-3">
            <label class="form-label">អុីម៉ែល</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email', $user->email) }}" required>
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- PASSWORD -->
        <div class="col-md-6 mb-3">
            <label class="form-label">ពាក្យសម្ងាត់</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                placeholder="New password (optional)">
            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>



        <!-- PHOTO -->
        <div class="col-md-6 mb-3">
            <label class="form-label">រូបថត</label>
            <input type="file" class="form-control" name="photo">

           
        </div>

        <div class="col-md-6">
             @if($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" width="160" class="mt-2 rounded">
            @endif
        </div>

    </div>

    <!-- BUTTONS -->
    <div class="modal-footer">
        <a href="#" class="btn btn-secondary btn-3" data-bs-dismiss="modal">Cancel</a>

        <button type="submit" class="btn btn-primary btn-5 ms-auto">
            <x-icon.plus />
            <span>Update User</span>
        </button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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