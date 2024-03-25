@include('header-footer.header')
@auth
<div class="container py-5">
    
        <h2 class="text-center">Users Data</h2>
        <div class="my-5 d-flex justify-content-between">
            <form id="emailForm"  action="{{route('emails')}}" method="post">
                @csrf
                <input type="hidden"  id="email_ids" name="email_ids">
                <button type="button" onclick="email_send_function(event)" class="btn btn-secondary  my-auto">Send Email to selected once</button>
            </form>
            
            <form method="post" action="{{route("del")}}">
                @csrf
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1">Delete All Records</button>
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Do you want to delete?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="d-flex justify-content-between m-4">
                            <button type="button" class="btn btn-secondary  my-3" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="delallrecord"  class="btn btn-danger my-3">Delete All Records</button>
                        </div>
                        </div>
                    </div>
                </div>
              
            </form>
           
            <form method="GET" action="{{route('search')}}" class="d-flex" role="search">
                <input class="form-control me-2" type="text" name="query" placeholder="Search" value="">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            
        </div>

        <div class="form my-5">
            <form  method="post" action="{{ route('insertrec') }}">
                @csrf
                <div class="d-flex justify-content-between" >
                        <label> Name : </label>
                        <input type="text" required id="name" name="name">
                        <label> Email : </label>
                        <input type="email" required id="email" name="email">
                        <label> Address : </label>
                        <input type="text" required id="address" name="address">
                        <label> Phone : </label>
                        <input type="tel" required id="phone" name="phone">
                        <button class="btn btn-info text-white" type="submit">Add</button>
                </div>
            </form>
        </div>
<table class="table table-bordered my-5">
    
      
        <thead>
            <tr>
            <th scope="col"><input type="checkbox"  id="select_all" ></th>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr> 
                 @foreach ($data as $id => $user)     
                        <td scope="row"> 
                            <form method="get">
                                <input type="checkbox" class="checkbox" name="array[]" id="ids[{{ $user->id}}]"  value="{{ $user->id}}">
                            </form>
                            </td>
                         <td> {{ $user->id}}</td>
                         <td scope="row"> {{ $user->name}}</td>
                         <td scope="row"> {{ $user->email}}</td>
                         <td scope="row"> {{ $user->address}}</td>
                         <td scope="row"> {{ $user->phone}}</td>
                            
                            <td> 
                                <form method="get" action="{{route('record', $user->id)}}">
                                     <button type="submit" class="btn btn-success">Edit</button></td>
                                </form>
                            <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}">Delete</button>
                            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{ $user->id }}">Do you want to delete?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="d-flex justify-content-between m-4">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a class="btn btn-danger" href="{{route('delete', ['id' => $user->id])}}"> Delete</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </td>
            </tr>
 @endforeach
        </tbody>
        
    </table>
    {{$data->links()}}
</div>

@endauth
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // $('#select_all').click(function(){
    //         $('.checkbox').prop('checked',$(this).prop('checked'));
    // });
    
    var selectAllCheckbox = document.getElementById('select_all');
    var checkboxes = document.querySelectorAll('.checkbox');
    selectAllCheckbox.addEventListener('click', function() {
        checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
    });
    
    function email_send_function(event){
        event.preventDefault();
        var selectedIds = [];
        var checkboxes = document.querySelectorAll('.checkbox:checked');
        checkboxes.forEach(function(checkbox) {
        selectedIds.push(checkbox.value);
        document.getElementById('email_ids').value = selectedIds.join(',');
        // alert(selectedIds);
        document.getElementById('emailForm').submit();
        });
    }
    
</script>
 
