@wrapper('admin.partials.widgets.widget_static', ['id' => 'vertical-menu-block', 'classes' => ''])
    {{ $config['block']->title ?? "" }}
@endwrapper


<div class="block-settings card" style="display: none;" key="{{ $key ?? 0 }}">
    <div class="card-body">
        <div class="card-title">
            <strong>Vertical menu</strong>
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Menu title')}}
            {{ Form::text('config['.$key.'][title]', $config['block']->title, ['class' => 'block-title form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('menu_id', 'Select menu')}}
            {{ Form::select('config['.$key.'][menu_id]', $menus, null, ['class' => 'form-control'])}}
        </div>

        {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4', 'type' => 'submit']) !!}
    </div>
</div>
