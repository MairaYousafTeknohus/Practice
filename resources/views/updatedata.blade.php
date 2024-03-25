
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


@foreach($data as $item)
<div class="container my-5">
    <h2 class="my-3 text-center">Edit Record {{ $item->id}}</h2>
    <form  method="post" action="{{ route('edit',$item->id) }}"	>
        @csrf
        <div  >
                <label> Name : </label>
                <input type="hidden" name="E-id" value="  {{ $item->id;}}">
                <input type="text"  class="px-3 my-2 w-100 py-2" id="name" name="E-name" value="{{ $item->name;}}">
                <label> Email : </label>
                <input type="email" class="px-3 my-2 w-100 py-2"  id="email" name="E-email" value="{{ $item->email;}}">
                <label> Address : </label>
                <input type="text" class="px-3 my-2 w-100 py-2" id="address" name="E-address" value="{{ $item->address;}}">
                <label> Phone : </label>
                <input type="tel"  id="phone" class="px-3 py-2 my-2 w-100" name="E-phone" value="{{ $item->phone;}}">
                <button class="btn btn-secondary text-white w-100 py-2 my-3" type="submit">Edit</button>
        </div>
    </form>
</div>
@endforeach

