@foreach($foods as $food)
    <div class="col-3">
        <img class="img-fluid" src="{{ asset("assets/images/" . $food->image) }}"
             alt="{{ $food->description }}"/>
        <h3 class="mt-2">{{ $food->name }}</h3>
        <p>{{ $food->description }}</p>
        <p>${{ $food->price }}</p>
    </div>
@endforeach
<div class="d-flex justify-content-center">
    {{ $foods->links() }}
</div>
