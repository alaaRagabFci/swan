@extends('admin_layouts.inc')
@section('title','فريق العمل')
@section('breadcrumb','فريق العمل')
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
          <span class="caption-subject bold uppercase">بيانات فريق العمل</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6">
              <div class="btn-group">
                <button  data-toggle="modal" data-target="#addModal" id="sample_editable_1_new" class="btn btn-primary">
                  أضافة فريق
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                <th class="col-md-1">الفئه</th>
                <th class="col-md-1">الأسم</th>
                <th class="col-md-1">رقم الجوال</th>
                <th class="col-md-1">البريد الألكتروني</th>
                <th class="col-md-1">الحي</th>
                <th class="col-md-1">الحاله</th>
                <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->category }}</td>
                    <td>{{  $row->name }}</td>
                    <td>{{  $row->phone }}</td>
                    <td>{{  $row->email }}</td>
                    <td>{{  $row->region }}</td>
                    <td>{{  $row->is_active }}</td>
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

      @include('admin_layouts.Add_Modal')
<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> تحديث</h4>
      </div>
      <form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url($modal) }}" data-toggle="validator">
        <div class="modal-body">
          @include($modal.'.form_update')
        </div>
        <div class="modal-footer">
          <button type="submit" id="submit" class="btn btn-primary">تحديث</button>
          <button type="button" class="btn btn-danger closeModal">غلق</button>
        </div>
      </form>
    </div>
  </div>
</div>
@include('admin_layouts.change-password')

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
          {data: 'category', name: 'category'},
          {data: 'name', name: 'name'},
          {data: 'phone', name: 'phone'},
          {data: 'email', name: 'email'},
            {data: 'region', name: 'region'},
            {data: 'is_active', name: 'is_active'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ]
        })
      });
    </script>
      <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
