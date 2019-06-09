@extends('admin_layouts.inc')
@section('title','أتصل بنا')
@section('breadcrumb','أتصل بنا')
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
          <span class="caption-subject bold uppercase">بيانات أتصل بنا</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                  <th class="col-md-1">رقم الرسالة</th>
                  <th class="col-md-1">الأسم</th>
                  <th class="col-md-1">الجوال</th>
                  <th class="col-md-1">البريد الألكتروني</th>
                  <th class="col-md-1">العنوان</th>
                  <th class="col-md-1">الرسالة</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->id }}</td>
                    <td>{{  $row->name }}</td>
                    <td>{{  $row->phone }}</td>
                    <td>{{  $row->email }}</td>
                    <td>{{  $row->title }}</td>
                    <td>{{  $row->message }}</td>
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
          {data: 'name', name: 'name'},
          {data: 'phone', name: 'phone'},
          {data: 'email', name: 'email'},
          {data: 'title', name: 'title'},
          {data: 'message', name: 'message'}
          ],
          order: [ [0, 'desc'] ]
        })
      });
    </script>
    @endsection
