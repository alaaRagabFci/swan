
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> أضافة {{ $modal_ }}</h4>
            </div>
            <form role="form" method="POST" class="addForm" action="{{ url($modal.'/store') }}" data-toggle="validator"  enctype="multipart/form-data">
                <div class="modal-body">
                    @include($modal.'.form')
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitForm" class="btn btn-primary">موافق</button>
                    <button type="button" class="btn btn-danger closeModal">غلق</button>
                </div>
            </form>
        </div>
    </div>
</div>

