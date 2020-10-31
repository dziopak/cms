<thead>
    <tr>
        @foreach($headers as $header => $row)
            <th>{{ __($header) }}</th>
        @endforeach
    </tr>
</thead>
