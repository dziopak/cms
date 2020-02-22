<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th style="width: 30px;"><input type="checkbox" class="select-all"></th>
                @foreach($table_headers as $header => $row)
                    <th>{{ $header }}</th>
                @endforeach
                @if (!empty($table_actions)) 
                    <th class="text-right">Actions</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($fields as $key => $field)
                <tr>
                    <td><input type="checkbox" name="mass_edit[{{ $key }}]" value="{{ $field->id }}"></td>
                    @foreach($table_headers as $key => $row)
                        <td>
                            @if (isset($field[$row]))
                                @if (!empty($table_data_types[$row]))
                                    @switch($table_data_types[$row])
                                        
                                        @case('boolean')
                                            {{ $field[$row] == 1 || $field[$row] == true ? "Yes" : "No" }}
                                        @break

                                        @case('name')
                                            {{ $field[$row]->name }}
                                        @break

                                        @case('date')
                                            {{ $field[$row]->diffForHumans() }}
                                        @break

                                        @case('image')
                                            <img src="/images/{{ $field[$row]->path}}" alt={{ $field->name }} width="60">
                                        @break
                                        
                                    @endswitch
                                @else
                                    {{ $field[$row] }}
                                @endif
                            @endif
                        </td>
                    @endforeach
                    @if (!empty($table_actions))
                        <td class="text-right">
                            @foreach($table_actions as $key => $action)
                                @if ($open_tag = strpos($action['url'], '{')) 
                                    <?php
                                        $close_tag = strpos($action['url'], '}');
                                        $field_name = substr($action['url'], ($open_tag + 1), ($close_tag - $open_tag - 1));
                                        $search = '#{.*?}#si';
                                        $action['url'] = preg_replace($search, strtolower($field[$field_name]), $action['url']);
                                    ?>
                                @endif
                                @if (!isset($action['access']) || Auth::user()->hasAccess($action['access']))
                                    @if (!empty($action['disabled']) && in_array($field->id, $action['disabled']))
                                        <a href="#" class="btn btn-secondary btn-disabled" disabled>LOCKED</a>    
                                    @else
                                        <a href="{{ route($action['url'], $field->id) }}" class="btn btn-{{ $action['class'] }}">{{ $key }}</a>    
                                    @endif
                                @endif
                            
                            @endforeach
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>