@extends('admin_layouts.inc')
@section('title','سعر الخدمات')
@section('breadcrumb','سعر الخدمات')
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
          <span class="caption-subject bold uppercase">بيانات سعر الخدمات</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6">
              <div class="btn-group">
                <button  data-toggle="modal" data-target="#addModal" id="sample_editable_1_new" class="btn btn-primary">
                  أضافة سعر
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                  <th class="col-md-1">نوع المكيف</th>
                  <th class="col-md-1">نوع الخدمه</th>
                  <th class="col-md-1">من</th>
                  <th class="col-md-1">الي</th>
                  <th class="col-md-1">السعر</th>
                  <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->airType }}</td>
                    <td>{{  $row->serviceType }}</td>
                    <td>{{  $row->range_from }}</td>
                    <td>{{  $row->range_to }}</td>
                    <td>{{  $row->price }}</td>
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
          {data: 'airType', name: 'airType'},
          {data: 'serviceType', name: 'serviceType'},
          {data: 'range_from', name: 'range_from'},
          {data: 'range_to', name: 'range_to'},
          {data: 'price', name: 'price'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ]
        })
      });
    </script>
    @endsection
