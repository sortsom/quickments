<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

<form action="{{route('attendance.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">ឈ្មោះបុគ្គលិក</label>
        <select id="select-tags" name="member">
            @foreach($members as $member)
            <option value="{{ $member->id }}">{{ $member->name }}</option>
            @endforeach

        </select>

    </div>

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">ថ្ងៃចាប់ផ្ដើម</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">ថ្ងៃបញ្ចប់</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date">

            </div>
        </div>
    </div>




    <!-- Flatpickr CSS -->
    <div class="row">
        <div class="col-6">

            <div class="mb-3">
                <label class="form-label">ម៉ោងចូលព្រឹក</label>
                <input type="time" class="form-control" name="time1" value="07:00">
                
            </div>
            

        </div>
        <div class="col-6">

            <div class="mb-3">
                <label class="form-label">ម៉ោងចេញព្រឹក</label>
                <input type="time" class="form-control" name="time2" value="12:00">
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-6">

            <div class="mb-3">
                <label class="form-label">ម៉ោងចូលរសៀល</label>
                <input type="time" class="form-control" name="time3" value="14:00">
            </div>

        </div>
        <div class="col-6">

            <div class="mb-3">
                <label class="form-label">ម៉ោងម៉ោងរសៀល</label>
                <input type="time" class="form-control" name="time4" value="18:00">
            </div>

        </div>
    </div>



    <div class="mb-3">
        <label class="form-label">កត់ចំណាំ</label>
        <textarea class="form-control @error('address') is-invalid @enderror" name="reason" placeholder="Address"
            rows="2"></textarea>

    </div>



    <div class="modal-footer">
        <a href="#" class="btn btn-secondary btn-3" data-bs-dismiss="modal"> Cancel
        </a>
        <button type="submit" class="btn btn-primary btn-5 ms-auto">
            <x-icon.plus />
            <span>បង្កើតថ្មី</span>
        </button>
    </div>
</form>
<!-- jQuery (មិនចាំបាច់បើមិនប្រើ plugin jQuery) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
flatpickr("#timepicker", {
    enableTime: true,
    altInput: true,
    allowInput: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "07:00"
});
</script>
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