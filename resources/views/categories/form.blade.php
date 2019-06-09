<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">أسم القسم</label>
    <input type="text" name="name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">x</label>
    <input type="number" name="x" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">عمولات بالنسبه المثويه فوق x</label>
    <input type="number" name="commission_more" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">عمولات بالنسبه المثويه تحت x</label>
    <input type="number" name="commission_less" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select  class="form-control" name="is_active">
        <option value="1">نشط</option>
        <option value="0">غير نشط</option>
    </select>
</div>