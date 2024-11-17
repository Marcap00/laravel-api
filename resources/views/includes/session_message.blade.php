@if (session('message'))
    <div class="alert alert-{{ session("alert-class") }}">
        {{ session('message') }}
    </div>
@endif
