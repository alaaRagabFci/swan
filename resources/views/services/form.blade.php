<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">أيكونة الخدمه</span>
    <span class="fileupload-exists">تغير</span>
    <input required type="file" name="icon"/></span>
    <span class="fileupload-preview"></span>
    <a href="#" required class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
    <span class="help-block with-errors errorName"></span>
</div>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الخدمه</label>
    <input type="text" name="name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الوصف</label>
    <textarea rows="4" cols="30" name="description" class="form-control" required></textarea>
</div>







