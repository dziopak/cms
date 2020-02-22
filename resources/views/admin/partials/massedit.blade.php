<div class="form-group row">
    <div class="col">
        {!! Form::label('mass_action', 'Select action...', []) !!}
        <div class="row mb-2">
            <div class="col-lg-3 col-8">
                {!! Form::select('mass_action', $mass_edit, null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-lg-1 col-md-2 col-4">
                {!! Form::submit('Go', ['class' => 'btn btn-primary w-100']) !!}
            </div>
        </div>
        @if (!empty($mass_edit_extend))
            @include('admin.partials.massedit.'.$mass_edit_extend)
        @endif
    </div>
</div>