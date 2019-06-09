<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">الأسم</label>
    <input type="text" name="name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">البريد الألكتروني</label>
    <input type="email" name="email" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">رقم الجوال</label>
    <input type="text" name="phone" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile"> الحي</label>
    <select required  class="form-control" name="region_id">
        <option selected value="">أختر الحي </option>
        @foreach($regions as $region)
            <option value="{!! $region->id !!}">{!! $region->name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الرقم السري</label>
    <input type="password" name="password" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile">تصدير فاتورة</label>
    <select required  class="form-control" name="is_export">
        <option selected value="">اختر</option>
        <option value="1">نعم</option>
        <option value="0">لا</option>
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select required class="form-control" name="is_active">
        <option selected value="">اختر</option>
        <option value="1">نشط</option>
        <option value="0">غير نشط</option>
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile">حظر المستخدم</label>
    <select required class="form-control" name="is_blocked">
        <option selected value="">اختر</option>
        <option value="1">حظر</option>
        <option value="0">ألغاء الحظر</option>
    </select>
</div>