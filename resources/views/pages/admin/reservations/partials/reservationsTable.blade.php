<div id="reservationsSection">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Table number</th>
            <th scope="col">Date and time start</th>
            <th scope="col">Date and time end</th>
            <th scope="col">description</th>
            <th scope="col">status</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
        </tr>
        </thead>
        <tbody id="usersTable">
        @php($number = $reservations->firstItem())
        @foreach($reservations as $reservation)
            <tr>
                <th scope="row">{{$number++}}</th>
                <td>{{$reservation->user}}</td>
                <td>{{$reservation->tableNumber}}</td>
                <td>{{$reservation->date_and_time_start}}</td>
                <td>{{$reservation->date_and_time_end}}</td>
                <td>{{($reservation->description) ? $reservation->description : '/'}}</td>
                <td>{{$reservation->status}}</td>
                <td><a href="{{ route('reservations.edit',$reservation->id) }}">
                        <button class="btn"><i class="bi bi-pen"></i></button>
                    </a></td>
                <td>
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
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
        {{ $reservations->links() }}
    </div>
</div>
