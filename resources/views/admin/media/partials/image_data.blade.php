@wrapper('admin.partials.wrapper', ['title' => 'admin/media.image_data'])
    <strong>{{ __('admin/media.size') }}:</strong> {{ getimagesize(public_path().'/images/'.$file->path)[0] }} x {{ getimagesize(public_path().'/images/'.$file->path)[1] }}<br/>
    <strong>{{ __('admin/media.weight') }}:</strong> {{ convert_bytes(filesize(public_path().'/images/'.$file->path), 'K') }} KB<br/>
    <strong>{{ __('admin/media.path') }}:</strong> <small>https://{{ $_SERVER['SERVER_NAME'] }}/images/{{ $file->path }}</small><br/>
@endwrapper
