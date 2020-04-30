<thead>
    <tr>
        <th style="width: 30px;"><input type="checkbox" class="select-all"></th>
        @foreach($table['headers'] as $header => $row)
            <th>{{ __($header) }}</th>
        @endforeach
        @if (!empty($table['actions']))
            @if ((!isset($actions) || $actions === true) && (!isset($controls) || $controls === true))
                <th class="text-right">{{ __('admin/general.actions') }}</th>
            @endif
        @endif
    </tr>
</thead>
