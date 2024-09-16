
<div class="modal fade modal-lg" id="edit-user-{{$user->id}}" tabindex="-1" aria-labelledby="edit-user" aria-hidden="true">
    <form method="post" action="{{route('admin.users.update', $user->id)}}">
        @csrf
        @method("put")
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mt-2" >
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name', $user->name)}}" readonly/>
                            <div class="invalid-feedback">Please user's full name.</div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Email</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$user->email}}" readonly>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="{{$user->username}}" readonly/>
                        </div>
                    </div>


                    <div class="row mt-3">
                         <div class="col-12">
                             <label for="bio" class="form-label">Bio</label>
                             <textarea name="bio" class="form-control" id="bio" readonly>{{$user->about_me}}</textarea>
                         </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="bio" class="form-label">User Status</label>
                            <select name="status" class="form-select">
                                <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="blocked" {{ $user->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </div>
        </div>
    </form>

</div>
