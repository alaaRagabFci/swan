<div class="modal fade" id="changePasswordModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> تغير كلمة السر</h4>
            </div>
            <form role="form" id="changePassword_form" method="POST" class="editForm"  action="{{ url($modal.'/change-password') }}" data-toggle="validator">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">الرقم السري</label>
                        <input type="password" name="password" required class="form-control">
                        <span class="help-block with-errors errorName"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit2" class="btn btn-primary">موافق</button>
                    <button type="button" class="btn btn-danger closeModal">غلق</button>
                </div>
            </form>
        </div>
    </div>
</div>
