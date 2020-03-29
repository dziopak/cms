<div class="card mb-3">
    <div class="card-body text-center">

        {{-- Display thumbnail --}}
        @if (!empty($params['thumbnail']))
            <img src="{{ __($params['thumbnail']) }}" alt="{{ __($params['title']) }}"/>
        @else
            <img src="/images/widgets/posts_statistics.png" alt="{{ __($params['title']) }}"/>
        @endif

        {{-- Display translated or static title --}}
        <strong class="widget-title"> {{ __($params['title']) }} </strong>

        @child
    </div>
</div>
