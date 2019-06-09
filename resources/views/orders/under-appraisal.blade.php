@extends('admin_layouts.inc')
@section('title','الطلبات تحت التقييم')
@section('breadcrumb','الطلبات تحت التقييم')
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
            <span class="caption-subject bold uppercase">بيانات الطلبات تحت التقييم</span>
          </div>
          <div class="tools"> </div>
        </div>
        <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="descriptions">
            <thead>
            <th class="col-md-1">رقم الطلب</th>
            <th class="col-md-1">أسم المستخدم</th>
            <th class="col-md-1">رقم الجوال</th>
            <th class="col-md-1">عدد التكييفات</th>
            <th class="col-md-1">نوع الخدمه</th>
            <th class="col-md-1">نوع المكيف</th>
            <th class="col-md-1">الحي</th>
            <th class="col-md-1">الشركة</th>
            <th class="col-md-1">خيارات</th>
            </thead>
            <tbody>
            @foreach ($tableData->getData()->data as $row)
              <tr>
                <td>{{  $row->id }}</td>
                <td>{{  $row->name }}</td>
                <td>{{  $row->phone }}</td>
                <td>{{  $row->air_number }}</td>
                <td>{{  $row->getServiceTypes }}</td>
                <td>{{  $row->getAirTypes }}</td>
                <td>{{  $row->region }}</td>
                <td>{{  $row->company }}</td>
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

  <div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i>  تقييمات المستخدم</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet light bordered">
                <div class="portlet-body">
                  <table class="table table-striped table-bordered table-hover" id="details">
                    <thead>
                    <th class="col-md-1">رقم الطلب</th>
                    <th class="col-md-1">الشركه</th>
                    <th class="col-md-1">المستخدم</th>
                    <th class="col-md-2">التقييم</th>
                    <th class="col-md-3">التعليق</th>
                    </thead>
                    <tbody id="rateDetails"></tbody>
                  </table>
                </div>
              </div>
              <!-- END EXAMPLE TABLE PORTLET-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/insert.js')}}" type="text/javascript"></script>
  <script type="text/javascript">
    $(document.body).validator().on('click', '.showAppraisals', function() {
      var self = $(this);
      self.button('loading');
      $.ajax({
        url: "rate-details/" + self.data('id') ,
        type: "GET",
        success: function(res){
          self.button('reset');
          $('#rateDetails').html(res);
          $('#details').DataTable({ retrieve: true, order: [ [0, 'desc'] ], language: {
              "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json"
            }});
          $('#orderDetailsModal').modal('show');
        },
        error: function(){
          self.button('reset');
        }
      });
    });
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
          {data: 'air_number', name: 'air_number'},
          {data: 'getServiceTypes', name: 'getServiceTypes'},
          {data: 'getAirTypes', name: 'getAirTypes'},
          {data: 'region', name: 'region'},
          {data: 'company', name: 'company'},
          {data: 'actions', name: 'actions'}
        ],
        order: [ [0, 'desc'] ]
      })
    });
  </script>
  <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
