@foreach ($users as $user)
    <tr>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->firstname }}</td>
        <td>{{ $user->middlename }}</td>
        <td>{{ $user->gender }}</td>
        <td>{{ $user->address }}</td>
    </tr>
@endforeach

