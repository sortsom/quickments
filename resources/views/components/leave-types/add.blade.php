<form action="{{ route('leave-types.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name (EN)</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Name (Khmer)</label>
        <input name="name_kh" type="text" class="form-control @error('name_kh') is-invalid @enderror">
        @error('name_kh')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Allowed</label>
        <select name="allowed" class="form-control @error('allowed') is-invalid @enderror" required>
            <option value="all">All</option>
            <option value="female">Female only</option>
            <option value="male">Male only</option>
        </select>
        @error('allowed')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Counting Days</label>
        <input name="counting_days" type="number" min="0" step="1"
            class="form-control @error('counting_days') is-invalid @enderror" value="0">
        @error('counting_days')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>

</form>
