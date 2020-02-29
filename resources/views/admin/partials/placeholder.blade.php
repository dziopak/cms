<div class="placeholder col-lg-{{ $size * 4 }}" data-size="{{ $size }}" draggable="true" id="{{ $name }}" data-name="{{ $name }}" ondragstart="drag(event)">
    <div style="height: 65px; " class="card my-2">
        <div class="card-body">
            <div class="card-title">
                {{ $name }}
            </div>
        </div>
    </div>
</div>