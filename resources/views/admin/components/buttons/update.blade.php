@if ($container)
    <div class="form-group">
@endif

<button type="submit" class="btn btn-primary">
    <i class="fa fa-home" aria-hidden="true"></i>
    {{ __('admin/general.update_button') }}
</button>

@if ($container)
    </div>
@endif
