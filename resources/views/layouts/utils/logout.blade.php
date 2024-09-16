
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
    <form method="POST" action="{{ auth()->user() ? route('logout') : route('admin.logout') }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </div>

            </div>
        </div>
    </form>
</div>
