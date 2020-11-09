<x-widget-block :config="$config" :key="$key">
    <div class="block-settings" style="display: none;" key="{{ $key ?? 0 }}">
        <div class="card-body">
            <div class="card-title">
                <strong>Custom HTML</strong>
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Block title')}}
                {{ Form::text('config['.$key.'][title]', $config['block']->title ?? "Untitled", ['class' => 'block-title form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('html', 'Block\'s HTML') }}
                {{ Form::textarea('config['.$key.'][html]', $config['block']->config['html'] ?? "", ['class' => 'form-control']) }}
                <small>Please, be cautious while pasting unknown or unverified code here, as it could not work properly with your current template.</small>
            </div>

            <div class="form-group">
                {{ Form::label('css', 'Block\'s CSS') }}
                {{ Form::textarea('config['.$key.'][css]', $config['block']->config['css'] ?? "", ['class' => 'form-control']) }}
            </div>

            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4']) !!}
        </div>
    </div>
</x-widget-block>
