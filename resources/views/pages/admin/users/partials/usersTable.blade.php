<div id="usersSection">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">email</th>
            <th scope="col">role</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
        </tr>
        </thead>
        <tbody>
        @php($number = $users->firstItem())
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$number++}}</th>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role_name}}</td>
                <td><a href="{{ route('users.edit',$user->id) }}">
                        <button class="btn"><i class="bi bi-pen"></i></button>
                    </a></td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center" id="paginationLinks">
        {{ $users->links() }}
    </div>
</div>
