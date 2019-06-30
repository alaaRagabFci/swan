<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">أسم الشركة</label>
    <input type="text" name="name" value="{{ $user->name }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>


<div class="form-group">
    <label for="exampleInputPassword1">رقم الجوال</label>
    <input type="text" name="phone" value="{{ $user->phone }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">البريد الألكتروني</label>
    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile"> الفئه</label>
    <select required  class="form-control" name="category_id">
        <option selected value="">أختر الفئه </option>
        @foreach($categories as $cat)
            <option @if($cat->id == $user->category_id) selected @endif value="{!! $cat->id !!}">{!! $cat->name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile"> الحي</label>
    <select required name="region_id[]" class="form-control select2-multiple" multiple="true">
        <optgroup label="regions">
            @foreach($regions as $region_id => $region_name)
                <option @if(in_array($region_id, $userRegions))? selected @endif value="{!! $region_id !!}">{!! $region_name !!}</option>
            @endforeach
        </optgroup>
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select  class="form-control" name="is_active">
        <option @if($user->is_active) selected @endif value="1">نشط</option>
        <option @if(!$user->is_active) selected @endif value="0">غير نشط</option>
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile">حظر المستخدم</label>
    <select  class="form-control" name="is_blocked">
        <option @if($user->is_blocked) selected @endif value="1">حظر</option>
        <option @if(!$user->is_blocked) selected @endif value="0">ألغاء الحظر</option>
    </select>
</div>