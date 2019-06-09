@extends('admin_layouts.inc')
@section('title','الفواتير')
@section('breadcrumb','الفواتير')
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
          <span class="caption-subject bold uppercase">بيانات الفواتير</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                  <th class="col-md-1">رقم الفاتوره</th>
                  <th class="col-md-1">رقم الطلب</th>
                  <th class="col-md-1">الشركة</th>
                  <th class="col-md-1">المبلغ الأجمالي</th>
                  <th class="col-md-1">العمولة</th>
                  <th class="col-md-1">الحالة</th>
                  <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->invoice_number }}</td>
                    <td>{{  $row->application }}</td>
                    <td>{{  $row->company }}</td>
                    <td>{{  $row->amount }}</td>
                    <td>{{  $row->commission }}</td>
                    <td>{!! $row->status !!}</td>
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
          {data: 'invoice_number', name: 'invoice_number'},
          {data: 'application', name: 'application'},
          {data: 'company', name: 'company'},
          {data: 'amount', name: 'amount'},
          {data: 'commission', name: 'commission'},
            {data: 'status', name: 'status'},
            {data: 'actions', name: 'actions'}
          ]
        })
      });
    </script>
      <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
