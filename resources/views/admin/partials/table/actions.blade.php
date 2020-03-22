@if (!empty($table['actions']))
    <td class="text-right">
        @foreach($table['actions'] as $key => $action)

            
            {{-- TO DO - move to helper function  --}}
            {{-- Inject ID or other field to action url --}}
            @if ($open_tag = strpos($action['url'], '{')) 
                <?php
                    $close_tag = strpos($action['url'], '}');
                    $field_name = substr($action['url'], ($open_tag + 1), ($close_tag - $open_tag - 1));
                    $search = '#{.*?}#si';
                    $action['url'] = preg_replace($search, strtolower($field[$field_name]), $action['url']);
                ?>
            @endif
            {{-- End --}}

            {{-- Display button --}}
            @if (!isset($action['access']) || Auth::user()->hasAccess($action['access']))
                @if (!empty($action['disabled']) && in_array($field->id, $action['disabled']))
                    <a href="#" class="btn btn-secondary btn-disabled" disabled><i class="fa fas fa-ban"></i></a>    
                @else
                    <a href="{{ route($action['url'], $field->id) }}" class="btn btn-{{ $action['class'] }}">
                        @include('admin.partials.table.action_type')
                    </a>    
                @endif
            @endif
            {{-- End --}}
        
        @endforeach
    </td>
@endif