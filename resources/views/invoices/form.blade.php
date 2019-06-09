<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select  class="form-control" name="status">
        <option value="Paid">مدفوع</option>
        <option value="Unpaid">غير مدفوع</option>
    </select>
</div>








