<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile"> نوع المكيف</label>
    <select required  class="form-control" name="air_type_id">
        <option selected value="">أختر النوع </option>
        @foreach($airTypes as $airType)
            <option value="{!! $airType->id !!}">{!! $airType->type !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile"> نوع الخدمه</label>
    <select required  class="form-control" name="service_id">
        <option selected value="">أختر النوع </option>
        @foreach($services as $service)
            <option value="{!! $service->id !!}">{!! $service->name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">من</label>
    <input type="number" min="1" name="range_from" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الي</label>
    <input type="number" min="1" name="range_to" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">السعر</label>
    <input type="number" min="1" name="price" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>








