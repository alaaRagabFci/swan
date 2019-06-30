@extends('admin_layouts.inc')
@section('title','الشركات')
@section('breadcrumb','الشركات')
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
          <span class="caption-subject bold uppercase">بيانات الشركات</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6">
              <div class="btn-group">
                <button  data-toggle="modal" data-target="#addModal" id="sample_editable_1_new" class="btn btn-primary">
                  أضافة شركه
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                <th class="col-md-1">الشركة</th>
                <th class="col-md-1">رقم الجوال</th>
                <th class="col-md-1">البريد الألكتروني</th>
                <th class="col-md-1">الأحياء</th>
                <th class="col-md-1">الفئه</th>
                <th class="col-md-1">الحاله</th>
                <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->name }}</td>
                    <td>{{  $row->phone }}</td>
                    <td>{{  $row->email }}</td>
                    <td>{{  $row->regions }}</td>
                    <td>{{  $row->category }}</td>
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
      <form role="form" id="update_form" method="POST" class="editForm" data-id=""  data-toggle="validator">
        <div class="modal-body asd">
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
      <script type="text/javascript">
          $(document).ready(function() {

              $("#changePasswordModal form").validator().on('submit', function(e){
                  if (!e.isDefaultPrevented())
                  {
                      var self = $(this);
                      $.ajax({
                          url: self.closest('form').attr('action')+ '/' + self.data('id') ,
                          type: "POST",
                          data: self.serialize(),
                          success: function(res){
                              $('#changePasswordModal').modal('hide');
                              swal({
                                  title: "تم تغير كلمة السر",
                                  type: "success",
                                  closeOnConfirm: false,
                                  confirmButtonText: "موافق !",
                                  confirmButtonColor: "#ec6c62",
                                  allowOutsideClick: true
                              });
                              oTable.draw();
                          },
                          error: function(){
                              swal({
                                  title: "حدث خطأ",
                                  type: "error",
                                  closeOnConfirm: false,
                                  confirmButtonText: "موافق !",
                                  confirmButtonColor: "#ff0000",
                                  allowOutsideClick: true
                              });
                          }
                      });
                      e.preventDefault();
                  }
              });

              //add siteoption
              $("#addModal form").on('submit', function(e){
                  if (!e.isDefaultPrevented())
                  {
                      var self = $(this);
                      var data = convert(self.serialize());
                      $.ajax({
                          url: self.closest('form').attr('action'),
                          type: "POST",
                          data: self.serialize(),
                          beforeSend: function(){
                              var values = Object.values(data);
                              for (i = 0; i < values.length; i++) {
                                  if (values[i] == "")
                                      return false;
                              }
                          },
                          success: function(res){
                              $('.addForm')[0].reset();
                              $('#addModal').modal('hide');
                              swal({
                                  title: "تم التسجيل بنجاح",
                                  type: "success",
                                  closeOnConfirm: false,
                                  confirmButtonText: "موافق !",
                                  confirmButtonColor: "#ec6c62",
                                  allowOutsideClick: true
                              });
                              oTable.draw();
                          },
                          error: function(error){
                              swal({
                                  title: error['responseJSON']['msg'],
                                  type: "error",
                                  closeOnConfirm: false,
                                  confirmButtonText: "موافق !",
                                  confirmButtonColor: "#ff0000",
                                  allowOutsideClick: true
                              });
                          }
                      });
                      e.preventDefault();
                  }
              });

              /* Edit Form */
              $(document.body).validator().on('click', '.edit2', function() {
                  var self = $(this);
                  self.button('loading');
                  $.ajax({
                      url: "{{ url($modal) }}" + '/' +self.data('id') + "/edit" ,
                      type: "GET",
                      success: function(res){
                          self.button('reset');
                          $('#editModal').modal('show');
                          $('#editModal form').attr("data-id", self.data('id') );
                          $('.asd').html(res);
                      },
                      error: function(){
                          self.button('reset');
                          alert('ff');
                      }
                  });
              });

              //Update
              $("#editModal form").validator().on('submit', function(e){
                  if (!e.isDefaultPrevented())
                  {
                      var self = $(this);
                      var data = convert(self.serialize());
                      $.ajax({
                          url: "companies/" +  self.attr("data-id"),
                          type: "POST",
                          data: "_method=PUT&" + self.serialize(),
                          beforeSend: function(){
                              var values = Object.values(data);
                              for (i = 0; i < values.length; i++) {
                                  if (values[i] == "")
                                      return false;
                              }
                          },
                          success: function(res){
                              $('#editModal').modal('hide');
                              swal({
                                  title: "تم التحديث بنجاح",
                                  type: "success",
                                  closeOnConfirm: false,
                                  confirmButtonText: "موافق !",
                                  confirmButtonColor: "#ec6c62",
                                  allowOutsideClick: true
                              });
                              oTable.draw();
                          },
                          error: function(error){
                              swal({
                                  title: error['responseJSON']['msg'],
                                  type: "error",
                                  closeOnConfirm: false,
                                  confirmButtonText: "موافق !",
                                  confirmButtonColor: "#ff0000",
                                  allowOutsideClick: true
                              });
                          }
                      });
                      e.preventDefault();
                  }
              });

              function convert(str){
                  str = str.replace(/\(|\)/g,'');
                  var arr = str.split('&');
                  var obj = {};
                  for (var i = 0; i < arr.length; i++) {
                      var singleArr = arr[i].trim().split('=');
                      var name = singleArr[0];
                      var value = singleArr[1];
                      if (obj[name] == undefined && name != "email") {
                          obj[name] = value;
                      }
                  }
                  return obj;
              }
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
          {data: 'name', name: 'name'},
          {data: 'phone', name: 'phone'},
          {data: 'email', name: 'email'},
          {data: 'regions', name: 'regions'},
          {data: 'category', name: 'category'},
          {data: 'is_active', name: 'is_active'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ]
        })
      });
    </script>
     <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
