{{-- Loop through images and display pivot fields --}}

    <div data-id="{{ $image->id ?? "@@ID@@" }}" class="carousel-row row px-2 py-4" style="border-bottom: 1px solid #eee;">


        <div class="col" style="max-width: 180px;">

            {{-- Thumbnail --}}
            <img class="float-left" src="/images/{{ $image->path ?? "@@PATH@@" }}" width="160" alt="{{ $image->name ?? 'Image' }}">

            {{-- Remove image from carousel --}}
            <div class="carousel-remove btn btn-danger w-100 my-4" data-id="{{ $image->id ?? "@@ID@@" }}">{{ __('admin/blocks/carousels.remove') }}</div>

        </div>

        <div class="col">

            @if (!empty($image->id))

                {{-- Title --}}
                <div class="form-group">
                    {!! Form::text('image['.$image->id.'][title]', $image->pivot->title, ['class' => 'form-control', 'placeholder' => __('admin/blocks/carousels.carousel_title')]) !!}
                </div>

                {{-- Button url --}}
                <div class="form-group">
                    {!! Form::text('image['.$image->id.'][url]', $image->pivot->url, ['class' => 'form-control', 'placeholder' => __('admin/blocks/carousels.carousel_url')]) !!}
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

