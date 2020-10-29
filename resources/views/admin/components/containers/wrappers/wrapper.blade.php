<div class="card mb-3">
    <div class="card-body">
        <div class="card-title">
            @if (!empty($title))
                <strong> {{ $title }}</strong>
            @endif
        </div>
        {{ $slot }}
    </div>
</div>
