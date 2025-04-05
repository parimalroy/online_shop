@if (!empty(session('error')))
    <div class="text text-danger mt-2 mb-2">
        {{ session('error') }}
    </div>
@endif
@if (!empty(session('success')))
    <div class="text text-success mt-2 mb-2">
        {{ session('success') }}
    </div>
@endif
