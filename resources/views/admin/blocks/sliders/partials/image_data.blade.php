{{-- Loop through images and display pivot fields --}}
@foreach($slider->files as $image)
    <div class="row px-2 py-4" style="border-bottom: 1px solid #eee;">


        {{-- Thumbnail --}}
        <div class="col" style="max-width: 180px;">
            <img class="float-left" src="/images/{{ $image->path }}" width="160" alt="{{ $image->name ?? 'Image' }}">
        </div>

        <div class="col">

            {{-- Title --}}
            <div class="form-group">
                {!! Form::text('image['.$image->id.'][title]', $image->pivot->title, ['class' => 'form-control', 'placeholder' => 'Title...']) !!}
            </div>

            {{-- Button url --}}
            <div class="form-group">
                {!! Form::text('image['.$image->id.'][url]', $image->pivot->url, ['class' => 'form-control', 'placeholder' => 'Redirect url...']) !!}
            </div>

            {{-- Description  --}}
            <div class="form-group">
                {!! Form::textarea('image['.$image->id.'][description]', $image->pivot->description, ['class' => 'form-control', 'placeholder' => 'Description or content here...']) !!}
            </div>

        </div>


    </div>
@endforeach
