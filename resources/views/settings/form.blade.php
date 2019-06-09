<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">الموقع</label>
    <input type="url" name="location" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">رقم الجوال</label>
    <input type="text" name="phone" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">تويتر</label>
    <input type="url" name="twitter" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الأنستجرام</label>
    <input type="url" name="instgram" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">البريد الألكتروني</label>
    <input type="email" name="email" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>


<div class="form-group">
    <label for="exampleInputPassword1">مدة أنتظار الطلب لقبوله عند الشركة بالدقيقه</label>
    <input type="number" min = "1" name="waiting_order_time" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">مدة ارسال التنبهات قبل الطلب بالدقيقه </label>
    <input type="number" min = "1" name="notify_time" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1"> مدة ارسال التنبهات للطلبات الغير مسندة</label>
    <input type="number" min = "1" name="not_assign_late_time" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">مقدمه تعريفيه عن الموقع</label>
    <textarea rows="4" cols="30" name="informations" class="form-control" required></textarea>
</div>







