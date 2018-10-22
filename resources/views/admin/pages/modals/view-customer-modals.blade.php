<div class="modal fade" id="myModalxs{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to <b>Block</b> <span>{{ $data->name }}</span> ?</p>
            </div>
            <form action="{{ url('/admin/block') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-footer">
                    <input type="hidden" name="user_id" value="{{ $data->id }}">
                    <input type="hidden" name="role" value="customers">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- unblock modal	 -->

<div class="modal fade" id="myModalx{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to <b>Unblock</b> {{ $data->name }} ?</p>
            </div>
            <form action="{{ url('/admin/unblock') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-footer">
                    <input type="hidden" name="user_id" value="{{ $data->id }}">
                    <input type="hidden" name="role" value="customers">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>