<div class="tab-pane fade profile-edit pt-3" id="profile-edit">

    <!-- Profile Edit Form -->
    <form method="post" action="{{route('panel.update-profile')}}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
            <div class="col-md-8 col-lg-9">
                <img src='{{asset("storage/profile-image/$user->profile_photo")}}' alt="Profile">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control" id="Email" value="{{$user->email}}" readonly>
            </div>

        </div>

        <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Username</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control" id="Email" value="{{$user->username}}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control" id="name" value="{{$user->name??old('name')}}">
            </div>
        </div>


        <div class="row mb-3">
            <label for="about_me" class="col-md-4 col-lg-3 col-form-label">About Me</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="about_me" class="form-control" id="about_me" style="height: 100px">{{$user->about_me ?? old('about_me')}}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Profile Photo</label>
            <div class="col-md-8 col-lg-9">
                <input name="profile_photo" type="file" class="form-control" id="name" value=""/>
            </div>
        </div>


        <div class="text-center">
            <button type="submit" class="btn btn-primary  float-end">Save Changes</button>
        </div>
    </form>
    <!-- End Profile Edit Form -->

</div>
