<div class="form-group row">
    <div class="col">
        {!! Form::label('mass_action', __('admin/partials.mass_action'), []) !!}
        <div class="row mb-2">
            <div class="col-lg-3 col-8">
                {!! Form::select('mass_action', $table['mass_edit'], null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-lg-1 col-md-2 col-4">
                {!! Form::submit(__('admin/partials.mass_submit'), ['class' => 'btn btn-primary w-100']) !!}
            </div>
        </div>
        @if (!empty($table['mass_edit_extend']))
            @include('admin.partials.massedit.'.$table['mass_edit_extend'])
        @endif
    </div>
</div>