<div class="actions" >
	<button data-toggle="tooltip" title="أضافة خدمة" type="button" class="addService Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fa fa-plus" aria-hidden="true"></i>
	</button>
	<button data-toggle="tooltip" title="تعديل الطلب" type="button" class="editOrder Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fa fa-pencil"></i></button>
	<button data-toggle="tooltip" title="أختيار شركه للطلب" type="button" class="assignCompany Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fa fa-building"></i></button>
	@if($status != 'Cancelled')
	<button data-toggle="tooltip" title="الغاء الطلب" type="button" onclick="changeOrderStatus('Cancelled', {{$id}})" class="Btn btn btn-danger btn-xs" data-id="{{$id}}"><i class="fa fa-ban" aria-hidden="true"></i>
	</button>
	@endif
	@if($status != 'Pending')
	<button data-toggle="tooltip" title="اعادة الطلب من البداية" type="button" onclick="changeOrderStatus('Pending', {{$id}})" class="Btn btn btn-info btn-xs" data-id="{{$id}}"><i class="fa fa-refresh" aria-hidden="true"></i>
	</button>
	@endif
	@if($status != 'Hanging')
	<button data-toggle="tooltip" title="تعليق الطلب" type="button" onclick="changeOrderStatus('Hanging', {{$id}})" class="Btn btn btn-warning btn-xs" data-id="{{$id}}"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>
	</button>
	@endif
	@if($status != 'Completed')
	<button data-toggle="tooltip" title="انهاء الطلب" type="button" onclick="changeOrderStatus('Completed', {{$id}})" class="Btn btn btn-success btn-xs" data-id="{{$id}}"><i class="fa fa-hourglass-end" aria-hidden="true"></i>
	</button>
	@endif
	{{--@if($status != 'Under_Appraisal')--}}
	{{--<button data-toggle="tooltip" title="تحت التقييم" type="button" onclick="changeOrderStatus('Under_Appraisal', {{$id}})" class="Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fa fa-star-o" aria-hidden="true"></i>--}}
	{{--</button>--}}
	{{--@endif--}}
	{{--@if(isset($rate) && $rate == 'Under_Appraisal')--}}
	{{--<button data-toggle="tooltip" title="أظهر التقييمات" type="button"  class="showAppraisals Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fa fa-eye-slash" aria-hidden="true"></i>--}}
	{{--</button>--}}
	{{--@endif--}}
</div>