@foreach ($users as $item)
    <tr id="{{ $item->id }}">
        <td class="edit-cell" data-column="lastname">{{ $item->lastname }}</td>
        <td class="edit-cell"data-column="firstname">{{ $item->firstname }}</td>
        <td class="edit-cell" data-column="middlename">{{ $item->middlename }}</td>
        <td class="edit-cell" data-column="gender">{{ $item->gender }}</td>
        <td class="edit-cell" data-column="address">{{ $item->address }}</td>
    </tr>
@endforeach
