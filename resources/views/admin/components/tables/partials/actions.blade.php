    <td class="text-right">
        @foreach($actions as $key => $action)

            {{-- Replace params in route --}}
            @php
                $action['url'] = replaceRouteParam($action['url'], $field);
            @endphp


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
                            <x-table-action-type :key="$key" />
                        </a>
                        @else
                        {{-- Modal button --}}
                        <div data-modal="{{ $action['modal'] }}" data-route="{{ route($action['url'], $field[$action['iterator']]) }}" class="modal-action btn btn-action btn-{{ $action['class'] }}">
                            <x-table-action-type :key="$key" />
                        </div>
                    @endif

                @endif

            @endif
            {{-- End --}}

        @endforeach
    </td>
