@extends('admin_layouts.inc')
@section('title','السجلات')
@section('breadcrumb','السجلات')
@section('styles')
@endsection
@section('content')
<!-- Main content -->
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="icon-settings font-dark"></i>
          <span class="caption-subject bold uppercase">بيانات السجلات</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                  <th class="col-md-1">رقم السجل</th>
                  <th class="col-md-2">المستخدم</th>
                  <th class="col-md-1">رقم الطلب</th>
                  <th class="col-md-2">الوصف</th>
                  <th class="col-md-2">الوقت</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->id }}</td>
                    <td>{{  $row->user }}</td>
                    <td>{{  $row->entity_id }}</td>
                    <td>{!! $row->description !!}</td>
                    <td>{{  $row->created_at }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div>
      </div>

      @endsection

      @section('scripts')
      <script type="text/javascript">
       $(document).ready(function() {
        oTable = $('#descriptions').DataTable({
          "processing": true,
          "serverSide": true,
          "responsive": true,
          'paging'      : true,
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json"
          },
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          "ajax": {{ $tableData->getData()->recordsFiltered }},
          "columns": [
          {data: 'id', name: 'id'},
          {data: 'user', name: 'user'},
          {data: 'entity_id', name: 'entity_id'},
          {data: 'description', name: 'description'},
          {data: 'created_at', name: 'created_at'}
          ],
            order: [ [0, 'desc'] ]
        })
      });
    </script>
      <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
