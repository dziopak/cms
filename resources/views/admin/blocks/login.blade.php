<x-widget-block :config="$config" :key="$key">
    <div class="block-settings" style="display: none;" key="{{ $key ?? 0 }}">
        <div class="card-body">
            <div class="card-title">
                <strong>Login form</strong>
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Block title')}}
                {{ Form::text('config['.$key.'][title]', $config['block']->title ?? "Untitled", ['class' => 'block-title form-control'])}}
            </div>

            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4']) !!}
        </div>
    </div>
</x-widget-block>
