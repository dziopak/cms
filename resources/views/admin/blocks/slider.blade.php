<x-widget-block :config="$config" :key="$key">
    <div class="block-settings" style="display: none;" key="{{ $key ?? 0 }}">
        <div class="card-body">
            <div class="card-title">
                <strong>Slider</strong>
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Block title')}}
                {{ Form::text('config['.$key.'][title]', $config['block']->title ?? "Untitled", ['class' => 'block-title form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('slider_id', 'Select slider')}}
                {{ Form::select('config['.$key.'][slider_id]', $sliders, $config['block']->config['slider_id'] ?? 1, ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('slider_id', 'Display controls')}}
                {{ Form::select('config['.$key.'][controls]', ['0' => 'No', '1' => 'Yes'], $config['block']->config['controls'] ?? 1, ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('layout', 'Slider\'s layout')}}
                {{ Form::select('config['.$key.'][layout]', ['1' => 'Hero', '2' => 'Regular', '3' => 'Regular with captions'], $config['block']->config['layout'] ?? 1, ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('autoplay', 'Autoplay speed') }}
                {{ Form::number('config['.$key.'][autoplay]', $config['block']->config['autoplay'] ?? 0, ['class' => 'form-control']) }}

                <small> 0 - No autoplay</small>
            </div>

            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4', 'type' => 'submit']) !!}
        </div>
    </div>
</x-widget-block>
