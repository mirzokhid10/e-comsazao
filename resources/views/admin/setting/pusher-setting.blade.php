<div class="tab-pane fade" id="pusher-setting" role="tabpanel" aria-labelledby="list-pusher-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.pusher-setting-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>pusher app id</label>
                    <input type="text" class="form-control" name="pusher_app_id" value="">
                </div>

                <div class="form-group">
                    <label>pusher key</label>
                    <input type="text" class="form-control" name="pusher_key" value="">
                </div>

                <div class="form-group">
                    <label>pusher secret</label>
                    <input type="text" class="form-control" name="pusher_secret" value="">
                </div>

                <div class="form-group">
                    <label>pusher cluster</label>
                    <input type="text" class="form-control" name="pusher_cluster" value="">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
