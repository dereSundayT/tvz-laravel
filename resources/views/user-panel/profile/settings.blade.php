<div class="tab-pane fade pt-3" id="profile-settings">

    <form action="{{ route('panel.change-profile-mode') }}" method="post">
        @csrf

        <div class="row mb-3">
            <label for="profileMode" class="col-md-4 col-lg-3 col-form-label">Profile Mode</label>
            <div class="col-md-8 col-lg-9">
                <div class="form-check">
                    <!-- Hidden input to handle unchecked checkbox -->
                    <input type="hidden" name="profile_mode" value="0">

                    <!-- Checkbox input -->
                    <input class="form-check-input"
                           type="checkbox"
                           id="is_private_profile"
                           name="is_private_profile"
                           value="1"
                          {{ old('is_private_profile', $user->is_private_profile) ? 'checked' : '' }}
                    />

                    <label class="form-check-label" for="is_private_profile">
                        Set Profile Private
                    </label>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>


</div>
