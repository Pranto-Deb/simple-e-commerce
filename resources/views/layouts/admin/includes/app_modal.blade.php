<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" class="GlobalFormValidationDelete">
                @method('DELETE')
                @csrf
                <div class="modal-body p-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <b>Alert!</b> Are You Sure ? Want To Delete This Item?
                            </div>
                        </div>
                        <div class="col-md-12">
                            @include('layouts.admin.includes.alert_message')
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
