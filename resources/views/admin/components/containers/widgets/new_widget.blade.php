<div class="card mb-3">
    <div class="card-body text-center">

        {{-- Display thumbnail --}}
        @if (!empty($thumbnail))
            <img src="{{ $thumbnail }}" alt="{{ __($title) }}"/>
        @endif

        {{-- Display translated or static title --}}
        <strong class="widget-title"> {{ __($title) }} </strong>

        {{ $slot }}
    </div>
</div>
