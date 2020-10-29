<thead>
    <tr>
        <th style="width: 30px;"><input type="checkbox" class="select-all"></th>

        @foreach($headers as $header => $row)
            <th>{{ __($header) }}</th>
        @endforeach

        @if (!empty($actions))
            @if ($show_actions)
                <th class="text-right">{{ __('admin/general.actions') }}</th>
            @endif
        @endif

    </tr>
</thead>
