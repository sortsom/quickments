@props(['requestLeave', 'members'])

<form action="{{ route('requestleave.update', $requestLeave->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">ឈ្មោះ</label>
        <select name="member_id" class="form-select" required>
            @foreach ($members as $member)
                <option value="{{ $member->id }}"
                    {{ old('member_id', $requestLeave->member_id) == $member->id ? 'selected' : '' }}>
                    {{ $member->name }}
                </option>
            @endforeach
        </select>
        @error('member_id')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>

    <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
        <button type="submit" class="btn btn-primary">
            <x-icon.edit /> Update
        </button>
    </div>
</form>
