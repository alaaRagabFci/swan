<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" class="airTypes" name="airTypes" value="">
<input type="hidden" class="serviceTypes" name="serviceTypes" value="">
<input type="hidden" class="numbers" name="numbers" value="">

<div class="form-group">
    <label for="exampleInputPassword1">الأسم</label>
    <input type="text" name="name" value="{{ $order->name }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">رقم الجوال</label>
    <input type="text" name="phone" value="{{ $order->phone }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">اليوم</label>
    <input type="date" name="day"  value="{{ $order->day }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile"> الوقت</label>
    <select required  class="form-control" name="hour_id">
        <option selected value="">أختر الوقت </option>
        @foreach($hours as $hour)
            @if($order->getHour->id == $hour->id)
                <option  selected value="{!! $hour->id !!}">{!! $hour->hour !!}</option>
            @else
                <option  value="{!! $hour->id !!}">{!! $hour->hour !!}</option>
            @endif
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile"> الحي</label>
    <select required  class="form-control" name="region_id">
        <option selected value="">أختر الحي </option>
        @foreach($regions as $region)
            @if($order->getRegion->id == $region->id)
                <option  selected value="{!! $region->id !!}">{!! $region->name !!}</option>
            @else
                <option  value="{!! $region->id !!}">{!! $region->name !!}</option>
            @endif
        @endforeach
    </select>
</div>

@foreach($orderAirServices as $airService)
    <div class="row">
        <div class="col-xs-4">
    <div class="form-group">
    <label for="exampleInputFile"> نوع التكييف</label><br>
    @foreach($airTypes as $type)
    @if($airService->air_type_id == $type->id)
        <input checked class="airType"  name="air_type_id{{ $airService->id }}" value="{{ $type->id }}"  type="radio">{{ $type->type }} <br>
    @else
        <input class="airType" name="air_type_id{{ $airService->id }}" value="{{ $type->id }}" type="radio">{{ $type->type }} <br>
    @endif
    @endforeach
    </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
    <label for="exampleInputFile"> نوع الخدمه</label><br>
    @foreach($services as $service)
    @if($airService->service_id == $service->id)
        <input checked class="serviceType" name="service_id{{ $airService->id }}" value="{{ $service->id }}" class="service_checkbox" data-id="{{ $service->id }}" type="radio">{{ $service->name }} <br>
    @else
        <input class="serviceType" name="service_id{{ $airService->id }}" value="{{ $service->id }}" class="service_checkbox" data-id="{{ $service->id }}" type="radio">{{ $service->name }} <br>
    @endif
    @endforeach
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
    <label for="exampleInputPassword1">عدد التكييفات</label>
    <input type="number" name="number" value="{{ $airService->number }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
    </div>
    </div>
    </div>
@endforeach
{{--<div class="form-group">--}}
    {{--<label for="exampleInputFile"> نوع التكييف</label><br>--}}
    {{--@foreach($airTypes as $type)--}}
        {{--@if(in_array($type->id, $orderGetAirTypes))--}}
            {{--<input checked  name="air_type_id" value="{{ $type->id }}"  type="checkbox">{{ $type->type }} <br>--}}
        {{--@else--}}
            {{--<input  name="air_type_id" value="{{ $type->id }}" type="checkbox">{{ $type->type }} <br>--}}
        {{--@endif--}}
    {{--@endforeach--}}
{{--</div>--}}

{{--<div class="form-group">--}}
    {{--<label for="exampleInputFile"> نوع الخدمه</label><br>--}}
        {{--@foreach($services as $service)--}}
        {{--@if(in_array($service->id, $orderGetServiceType))--}}
            {{--<input checked  name="service_id" value="{{ $service->id }}" class="service_checkbox" data-id="{{ $service->id }}" type="checkbox">{{ $service->name }} <br>--}}
        {{--@else--}}
            {{--<input  name="service_id" value="{{ $service->id }}" class="service_checkbox" data-id="{{ $service->id }}" type="checkbox">{{ $service->name }} <br>--}}
        {{--@endif--}}
        {{--@endforeach--}}
{{--</div>--}}

{{--<div class="form-group">--}}
    {{--<label for="exampleInputPassword1">عدد التكييفات</label>--}}
    {{--<input type="number" name="air_condition_number" value="{{ $order->air_condition_number }}" required class="form-control">--}}
    {{--<span class="help-block with-errors errorName"></span>--}}
{{--</div>--}}