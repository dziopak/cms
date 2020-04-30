@wrapper('admin.partials.widgets.widget_static', ['id' => 'footer-block', 'classes' => ''])
    <div class="block-settings" style="display: none;" key="{{ $key ?? 0 }}">
        <div class="card-body">
            <div class="card-title">
                <strong>Footer</strong>
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Footer title')}}
                {{ Form::text('config['.$key.'][title]', $config['block']->title ?? "Untitled", ['class' => 'block-title form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Footer content')}}
                {{ Form::text('config['.$key.'][title]', $config['block']->config['content'] ?? config('global.general.title').' Copyright &copy;', ['class' => 'block-title form-control'])}}
            </div>

            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4', 'type' => 'submit']) !!}
        </div>
    </div>
@endwrapper
