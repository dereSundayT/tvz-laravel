
<div class="modal fade" id="view-user-{{$user->id}}" tabindex="-1" aria-labelledby="view-user" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mt-2" >
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" readonly>
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
                            <input type="text" name="username" class="form-control" id="username" value="{{$user->username}}" readonly>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" id="bio" rows="5" readonly>{{$user->about_me}}</textarea>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="bio" class="form-label">User Status</label>
                            <input type="text" name="username" class="form-control" id="username" value="{{$user->status}}"/>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
</div>
