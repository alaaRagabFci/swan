<div class="modal fade" id="editModalOrder" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> تحديث</h4>
            </div>
            <form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url($modal) }}" data-toggle="validator">
                <div class="modal-body orderData">

                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary">تحديث</button>
                    <button type="button" class="btn btn-danger closeModal">غلق</button>
                </div>
            </form>
        </div>
    </div>
</div>