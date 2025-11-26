<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

<form action="{{ route('attendance.update', $att->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">ឈ្មោះបុគ្គលិក</label>
        <select name="member" id="select-tags" class="form-control" >
            @foreach($members as $m)
            <option value="{{ $m->id }}" {{ $att->member_id == $m->id ? 'selected' : '' }}>
                {{ $m->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-12">
            <label class="form-label">កាលបរិច្ឆេទ</label>
            <input 
                type="date" 
                class="form-control" 
                name="date"
                value="{{ $att->date ? \Carbon\Carbon::parse($att->date)->format('Y-m-d') : '' }}">
        </div>
    </div>

    @php
        $mi = $att->details->where('check_type',1)->first();
        $mo = $att->details->where('check_type',2)->first();
        $ai = $att->details->where('check_type',3)->first();
        $ao = $att->details->where('check_type',4)->first();
    @endphp

    <div class="row mt-3">
        <div class="col-6">
            <label>ម៉ោងចូលព្រឹក</label>
            <input type="text" name="time1" class="form-control time-picker"
                value="{{ isset($mi->clock) ? \Carbon\Carbon::parse($mi->clock)->format('H:i') : '' }}">
        </div>

        <div class="col-6">
            <label>ម៉ោងចេញព្រឹក</label>
            <input type="text" name="time2" class="form-control time-picker"
                value="{{ isset($mo->clock) ? \Carbon\Carbon::parse($mo->clock)->format('H:i') : '' }}">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-6">
            <label>ម៉ោងចូលរសៀល</label>
            <input type="text" name="time3" class="form-control time-picker"
                value="{{ isset($ai->clock) ? \Carbon\Carbon::parse($ai->clock)->format('H:i') : '' }}">
        </div>

        <div class="col-6">
            <label>ម៉ោងចេញរសៀល</label>
            <input type="text" name="time4" class="form-control time-picker"
                value="{{ isset($ao->clock) ? \Carbon\Carbon::parse($ao->clock)->format('H:i') : '' }}">
        </div>
    </div>

    <div class="mb-3 mt-3">
        <label>កត់ចំណាំ</label>
        <textarea name="reason" class="form-control" rows="2">{{ trim($mi->reason ?? $mo->reason ?? $ai->reason ?? $ao->reason ?? '') }}</textarea>
    </div>

    <button class="btn btn-primary mt-2">Update</button>
</form>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
// === Time Picker ===
flatpickr(".time-picker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    allowInput: true,
});

// === Tom Select ===
document.addEventListener("DOMContentLoaded", function() {
    if (window.TomSelect) {
        new TomSelect("#select-tags", {
            plugins: ['remove_button'],
            create: false,
            maxItems: 1
        });
    }
});
</script>
