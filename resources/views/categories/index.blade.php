@extends('admin_layouts.inc')
@section('title','الأقسام')
@section('breadcrumb','الأقسام')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('styles')
  <link href="{{ asset('/admin_ui/assets/layouts/layout4/css/image.css')}}" rel="stylesheet" type="text/css" />
  <style>
    #categories tr {
      cursor: move;
    }

  </style>
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
            <span class="caption-subject bold uppercase">بيانات الأقسام</span>
          </div>
          <div class="tools"> </div>
        </div>
        <div class="portlet-body">
          <div class="table-toolbar">
            <div class="row">
              <div class="col-md-6">
                <div class="btn-group">
                  <button  data-toggle="modal" data-target="#addModal" id="sample_editable_1_new" class="btn btn-primary">
                    أضافة قسم
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-striped table-bordered table-hover table-header-fixed" id="categories">
            <thead>
            <th class="col-md-1">الترتيب</th>
            <th class="col-md-1">أسم القسم</th>
            <th class="col-md-1">x</th>
            <th class="col-md-1">عمولات فوق x</th>
            <th class="col-md-1">عمولات تحت x</th>
            <th class="col-md-1">نشط</th>
            <th class="col-md-1">خيارات</th>
            </thead>
            <tbody class="row_position">
            @foreach ($tableData->getData()->data as $row)
              <tr>
                <td>{{  $row->sort }}</td>
                <td>{{  $row->name }}</td>
                <td>{{  $row->x }}</td>
                <td>{{  $row->commission_more }}</td>
                <td>{{  $row->commission_less }}</td>
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
  @include('admin_layouts.Edit_Modal')

@endsection

@section('scripts')
  <script type="text/javascript">

    $( ".row_position" ).sortable({
      delay: 50,
      stop: function() {
        var selectedData = new Array();
        $('.row_position tr').each(function() {
          selectedData.push($(this).attr("id"));
        });
        updateOrder(selectedData);

      }

    });

    function updateOrder(data) {
      $.ajax({
        url: "{{ url('categories/sort') }}",
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: Object.assign({}, data),
        success: function(res){
          oTable.draw();
        },
        error: function(){}
      });
    }

  </script>
  <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/insert.js')}}" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      oTable = $('#categories').DataTable({
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
          {data: 'sort', name: 'sort'},
          {data: 'name', name: 'name'},
          {data: 'x', name: 'x'},
          {data: 'commission_more', name: 'commission_more'},
          {data: 'commission_less', name: 'commission_less'},
          {data: 'is_active', name: 'is_active'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ],
        order: [ [0, 'asc'] ]
      });
    });
  </script>
@endsection
