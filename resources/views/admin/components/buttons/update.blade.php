@if ($container)
    <div class="form-group">
@endif

<button type="submit" class="btn btn-primary" {{ !empty($id) ? "id=".$id : "" }}>
    <i class="fa fa-home" aria-hidden="true"></i>
    {{ __('admin/general.update_button') }}
</button>

@if ($container)
    </div>
@endif
