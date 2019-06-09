<div class="actions" >
	@if(strpos(\Request::url(), 'company-accepted-orders') || strpos(\Request::url(), 'team-accepted-orders'))
		<button @if(count($getInvoice) > 0)  disabled @endif data-toggle="tooltip" title="أضافة خدمة" type="button" class="addService Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fa fa-plus" aria-hidden="true"></i>
		</button>
		<button @if(count($getInvoice) > 0)  disabled @endif data-toggle="tooltip" title="تصدير فاتورة" type="button" onclick="getOrderDetails({{ $id }})" class="Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fas fa-file-invoice"></i>
		</button>
	@else
		<button data-toggle="tooltip" title="قبول الطلب" type="button" onclick="agreeOrder({{ $id }})" class="agreeOrder Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fa fa-check" aria-hidden="true"></i>
		</button>
	@endif
</div>

