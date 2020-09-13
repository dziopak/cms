@if (!empty($categories))
    <div class="col-lg-3 col-8">
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    </div>
@endif
