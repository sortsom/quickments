@if(session('success'))
<div class="alert alert-success success-alert" role="alert" style="opacity:1; transition: opacity 0.5s;">
    <div class="alert-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12l5 5l10 -10"></path>
        </svg>
    </div>
    {{ session('success') }}
</div>

@if(session('log'))
<div class="alert alert-success success-alert" role="alert" style="opacity:1; transition: opacity 0.5s;">
    <div class="alert-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12l5 5l10 -10"></path>
        </svg>
    </div>
    <ul>
        @foreach(session('log') as $row)
        <li>{{ $row['date'] }} - {{ $row['status'] }} ({{ $row['reason'] }})</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('summary'))
<div class="alert alert-info mt-2 success-alert">
    <strong>Total Days:</strong> {{ session('summary')['total_days'] }}<br>
    <strong>Inserted:</strong> {{ session('summary')['inserted'] }}<br>
    <strong>Skipped:</strong> {{ session('summary')['skipped'] }}
</div>
@endif


<script>
document.addEventListener('DOMContentLoaded', function() {
    const alertBoxes = document.querySelectorAll('.success-alert');

    alertBoxes.forEach(alertBox => {
        setTimeout(() => {
            alertBox.style.opacity = '0';

            setTimeout(() => alertBox.remove(), 5000);

        }, 5000);
    });
});
</script>
@endif