
<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post"  action="{{route('admin.users.add')}}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content px-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mt-2" >
                        <div class="col-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}"/>
                            <div class="invalid-feedback">Please user's full name.</div>
                        </div>

                        <div class="col-6">
                            <label for="name" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}"/>
                        </div>
                    </div>

                    <div class="row mt-3">

                    </div>


                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="{{old('username')}}" />
                        </div>

                        <div class="col-6">
                            <label for="bio" class="form-label">User Status</label>
                            <select name="status" class="form-select">
                                <option value="inactive">Inactive</option>
                                <option value="active">Active</option>
                                <option value="blocked">Blocked</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea name="about_me" class="form-control" id="about_me" rows="3">{{old('about_me')}}</textarea>
                        </div>
                    </div>




                    {{--Password--}}
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="{{old('password')}}" />
                        </div>

                        <div class="col-6">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" value="{{old('password_confirmation')}}" />
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </div>
    </form>
</div>
