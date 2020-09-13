@if (!empty($table['actions']))
    <td class="text-right">
        @foreach($table['actions'] as $key => $action)

            {{-- TO DO - move to helper function  --}}
            {{-- Inject ID or other field to action url --}}
            @if ($open_tag = strpos($action['url'], '{'))
                @php
                    $close_tag = strpos($action['url'], '}');
                    $field_name = substr($action['url'], ($open_tag + 1), ($close_tag - $open_tag - 1));
                    $search = '#{.*?}#si';
                    $action['url'] = preg_replace($search, strtolower($field[$field_name]), $action['url']);
                @endphp
            @endif
            {{-- End --}}

            {{-- Display button --}}
            @if (!isset($action['access']) || Auth::user()->hasAccess($action['access']))

                @if (!empty($action['disabled']) && in_array($field->id, $action['disabled']))
                    {{-- Disabled button --}}
                    <a href="#" class="btn btn-secondary btn-disabled" disabled><i class="fa fas fa-ban"></i></a>
                @else
                    @php
                        if (!isset($action['iterator'])) $action['iterator'] = 'id';
                    @endphp

                    @if(empty($action['modal']))
                        {{-- Regular button --}}
                        <a href="{{ route($action['url'], $field[$action['iterator']]) }}" class="btn btn-action btn-{{ $action['class'] }}">
                            @include('admin.partials.table.action_type')
                        </a>
                    @else
                        {{-- Modal button --}}
                        <div data-modal="{{ $action['modal'] }}" data-route="{{ route($action['url'], $field[$action['iterator']]) }}" class="modal-action btn btn-action btn-{{ $action['class'] }}">
                            @include('admin.partials.table.action_type')
                        </div>
                    @endif

                @endif

            @endif
            {{-- End --}}

        @endforeach
    </td>
@endif
