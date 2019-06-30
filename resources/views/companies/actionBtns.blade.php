<div class="actions" >
	<button type="button" class="edit2 Btn btn btn-default btn-xs" data-id="{{$id}}"><i class="fa fa-pencil"></i></button>
	<form action="{{ url( strtolower($controller), $id) }}" class="deleteForm" method="POST" style="display: inline;">
		<input type="hidden" name="_method" value="DELETE">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
	</form>
	@if(strpos(\Request::url(), 'companies') || strpos(\Request::url(), 'team-works'))
	<button type="button" class="changePassword2 Btn btn btn-default btn-xs" data-id="{{$id}}">كلمة السر<i class="fa fa-pencil"></i></button>
@endif
</div>
