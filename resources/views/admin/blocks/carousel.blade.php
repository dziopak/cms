<x-widget-block :config="$config" :key="$key">
    <div class="block-settings" style="display: none;" key="{{ $key ?? 0 }}">
        <div class="card-body">
            <div class="card-title">
                <strong>Carousel</strong>
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Block title')}}
                {{ Form::text('config['.$key.'][title]', $config['block']->title ?? "Untitled", ['class' => 'block-title form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('carousel_id', 'Select carousel')}}
                {{ Form::select('config['.$key.'][carousel_id]', $carousels, $config['block']->config['carousel_id'] ?? 1, ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('controls', 'Display controls')}}
                {{ Form::select('config['.$key.'][controls]', ['0' => 'No', '1' => 'Yes'], $config['block']->config['controls'] ?? 1, ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('autoplay', 'Autoplay speed') }}
                {{ Form::number('config['.$key.'][autoplay]', $config['block']->config['autoplay'] ?? 0, ['class' => 'form-control']) }}

                <small> 0 - No autoplay</small>
            </div>

            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4']) !!}
        </div>
    </div>
</x-widget-block>
