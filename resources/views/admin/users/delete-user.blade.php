
<div class="modal fade" id="delete-user-{{$user->id}}" tabindex="-1" aria-labelledby="delete-user" aria-hidden="true">
    <form method="post" action="{{route('admin.users.delete', $user->id)}}">
       @csrf
        @method("delete")
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete {{$user->name}} User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user? <br/>
                    <b>Name</b> : {{$user->name}} <br/>
                    <b>Email</b> : {{$user->email}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete User</button>
                </div>
            </div>
        </div>
    </form>

</div>
