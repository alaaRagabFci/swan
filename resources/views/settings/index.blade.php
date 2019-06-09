@extends('admin_layouts.inc')
@section('title','الأعدادات')
@section('breadcrumb','الأعدادات')
@section('styles')
  <link href="{{ asset('/admin_ui/assets/layouts/layout4/css/image.css')}}" rel="stylesheet" type="text/css" />
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
          <span class="caption-subject bold uppercase">بيانات الأعدادات</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                  <th class="col-md-1">الموقع</th>
                  <th class="col-md-1">رقم الجوال</th>
                  <th class="col-md-1">البريد الألكتروني</th>
                  <th class="col-md-1">تويتر</th>
                  <th class="col-md-1">الأنستجرام</th>
                  <th class="col-md-1">مدة أنتظار الطلب لقبوله </th>
                  <th class="col-md-1">مدة ارسال التنبهات قبل الطلب</th>
                  <th class="col-md-1"> مدة ارسال التنبهات للطلبات الغير مسندة</th>
                  <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->location }}</td>
                    <td>{{  $row->phone }}</td>
                    <td>{{  $row->email }}</td>
                    <td>{{  $row->twitter }}</td>
                    <td>{{  $row->instgram }}</td>
                    <td>{{  $row->waiting_order_time }}</td>
                    <td>{{  $row->notify_time }}</td>
                    <td>{{  $row->not_assign_late_time }}</td>
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

      @include('admin_layouts.Edit_Modal')

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
          {data: 'location', name: 'location'},
          {data: 'phone', name: 'phone'},
          {data: 'email', name: 'email'},
          {data: 'twitter', name: 'twitter'},
          {data: 'instgram', name: 'instgram'},
          {data: 'waiting_order_time', name: 'waiting_order_time'},
          {data: 'notify_time', name: 'notify_time'},
          {data: 'not_assign_late_time', name: 'not_assign_late_time'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ]
        })
      });
    </script>
      <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
