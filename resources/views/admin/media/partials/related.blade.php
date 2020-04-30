@wrapper('admin.partials.wrapper', ['title' => 'admin/media.attached_to_title'])
    <ul>
        @foreach($file->getRelated() as $related)
            <li>
                <strong>{{ class_basename($related) }}:</strong>
                <a href="{{ route('admin.'.strtolower(class_basename($related)).'s.edit', $related->id) }}">
                    {{ $related->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endwrapper
