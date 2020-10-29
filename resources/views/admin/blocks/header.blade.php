<x-widget-block :config="$config" :key="$key">
    <div class="block-settings" style="display: none;" key="{{ $key ?? 0 }}">
        <div class="card-body">
            <div class="card-title">
                <strong>Header</strong>
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Header title')}}
                {{ Form::text('config['.$key.'][title]', $config['block']->title ?? "Untitled", ['class' => 'block-title form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('slogan', 'Slogan')}}
                {{ Form::text('config['.$key.'][slogan]', $config['block']->config['slogan'] ?? null, ['class' => 'form-control'])}}
            </div>

            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4', 'type' => 'submit']) !!}
        </div>
    </div>
</x-widget-block>
