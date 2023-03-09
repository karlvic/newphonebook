

@foreach ($users as $item)
    <tr id="{{ $item->id }}" class="clickable-row">
        <td>{{ $item->lastname }}</td>
        <td>{{ $item->firstname }}</td>
        <td>{{ $item->middlename }}</td>
        <td>{{ $item->gender }}</td>
        <td>{{ $item->address }}</td>
    </tr>
@endforeach
