@php
    $align = [
        '0' => __('admin/general.to_left'),
        '1' => __('admin/general.to_right'),
        '2' => __('admin/general.to_middle')
    ];
@endphp

<x-widget-block :config="$config" :key="$key">
    {{ $config['block']->title ?? "Untitled" }}
    <div class="block-settings" style="display: none;" key="{{ $key ?? 0 }}">
        <div class="card-body">
            <div class="card-title">
                <strong>horizontal menu</strong>
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Menu title')}}
                {{ Form::text('config['.$key.'][title]', $config['block']->title ?? "Untitled", ['class' => 'block-title form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('menu_id', 'Select menu')}}
                {{ Form::select('config['.$key.'][menu_id]', $menus, $config['block']->config['menu_id'] ?? 1, ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{ Form::label('align', __('admin/general.align'))}}
                {{ Form::select('config['.$key.'][align]', $align, $config['block']->config['align'] ?? 0, ['class' => 'form-control'])}}
            </div>

            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4']) !!}
        </div>
    </div>
</x-widget-block>



