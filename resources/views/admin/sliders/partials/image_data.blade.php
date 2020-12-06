{{-- Loop through images and display pivot fields --}}

    <div data-id="{{ $image->id ?? "@@ID@@" }}" class="slider-row row px-2 py-4" style="border-bottom: 1px solid #eee;">


        <div class="col" style="max-width: 180px;">

            {{-- Thumbnail --}}
            <img class="float-left" src="/images/{{ $image->path ?? "@@PATH@@" }}" width="160" alt="{{ $image->name ?? 'Image' }}">

            {{-- Remove image from slider --}}
            <div class="slider-remove btn btn-danger w-100 my-4" data-id="{{ $image->id ?? "@@ID@@" }}">{{ __('admin/blocks/sliders.remove') }}</div>

        </div>

        <div class="col">

            @if (!empty($image->id))

                {{-- Title --}}
                <div class="form-group">
                    {!! Form::text('image['.$image->id.'][title]', $image->pivot->title, ['class' => 'form-control', 'placeholder' => __('admin/blocks/sliders.slide_title')]) !!}
                </div>

                {{-- Button url --}}
                <div class="form-group">
                    {!! Form::text('image['.$image->id.'][url]', $image->pivot->url, ['class' => 'form-control', 'placeholder' => __('admin/blocks/sliders.slide_url')]) !!}
                </div>

                {{-- Description  --}}
                <div class="form-group">
                    {!! Form::textarea('image['.$image->id.'][description]', $image->pivot->description, ['class' => 'form-control', 'placeholder' => __('admin/blocks/sliders.slide_content') ]) !!}
                </div>

            @else

                {{-- Title --}}
                <div class="form-group">
                    {!! Form::text('image[@@ID@@][title]', null, ['class' => 'form-control', 'placeholder' => 'Title...']) !!}
                </div>

                {{-- Button url --}}
                <div class="form-group">
                    {!! Form::text('image[@@ID@@][url]', null, ['class' => 'form-control', 'placeholder' => 'Redirect url...']) !!}
                </div>

                {{-- Description  --}}
                <div class="form-group">
                    {!! Form::textarea('image[@@ID@@][description]', null, ['class' => 'form-control', 'placeholder' => 'Description or content here...']) !!}
                </div>

            @endif

        </div>


    </div>

