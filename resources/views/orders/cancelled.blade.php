@extends('admin_layouts.inc')
@section('title','الطلبات الملغية')
@section('breadcrumb','الطلبات الملغية')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            <span class="caption-subject bold uppercase">بيانات الطلبات الملغية</span>
          </div>
          <div class="tools"> </div>
        </div>
        <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="descriptions">
            <thead>
            <th class="col-md-1">رقم الطلب</th>
            <th class="col-md-1">أسم المستخدم</th>
            <th class="col-md-1">رقم الجوال</th>
            <th class="col-md-1">نوع الخدمه</th>
            <th class="col-md-1">نوع المكيف</th>
            <th class="col-md-1">عدد التكييفات</th>
            <th class="col-md-1">الحي</th>
            <th class="col-md-1">الشركة</th>
            <th class="col-md-1">الوقت</th>
            <th class="col-md-1">خيارات</th>
            </thead>
            <tbody>
            @foreach ($tableData->getData()->data as $row)
              <tr>
                <td>{{  $row->id }}</td>
                <td>{{  $row->name }}</td>
                <td>{{  $row->phone }}</td>
                <td>{{  $row->getServiceTypes }}</td>
                <td>{{  $row->getAirTypes }}</td>
                <td>{{  $row->air_number }}</td>
                <td>{{  $row->region }}</td>
                <td>{{  $row->company }}</td>
                <td>{{  $row->created_at }}</td>
                <td>{!! $row->actions !!}</td>
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
  <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/insert.js')}}" type="text/javascript"></script>
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
          {data: 'name', name: 'name'},
          {data: 'phone', name: 'phone'},
          {data: 'getServiceTypes', name: 'getServiceTypes'},
          {data: 'getAirTypes', name: 'getAirTypes'},
          {data: 'air_number', name: 'air_number'},
          {data: 'region', name: 'region'},
          {data: 'company', name: 'company'},
          {data: 'created_at', name: 'created_at'},
          {data: 'actions', name: 'actions'}
        ],
        order: [ [0, 'desc'] ]
      })
    });
  </script>
  <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
