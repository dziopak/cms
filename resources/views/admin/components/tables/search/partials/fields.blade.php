<tr>
    <td>
        @if ($field->searchable->thumbnail)
            <img src="/images/{{ $field->searchable->thumbnail->path }}" width="60" />
        @endif
        @if ($field->searchable->photo)
            <img src="/images/{{ $field->searchable->photo->path }}" width="60" />
        @endif
    </td>

    <td>
        <a href="{{ $field->url }}">
            {{ $field->title }}
        </a>
    </td>

    <td>
        {{ __('admin/search.types.'.$field->type) }}
    </td>

    <td>
        <a href="{{ $field->url }}" class="btn btn-action btn-success">
            <i class="fa fas fa-edit"></i>
        </a>
    </td>
</tr>
