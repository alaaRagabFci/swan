<!DOCTYPE html>
<html lang="en" dir="rtl">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>صون | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #4 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <link href="{{ asset('/admin_ui/assets/global/plugins/font-awesome/css/all.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/global/css/components-rtl.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />

    <link href="{{ asset('/admin_ui/assets/global/css/plugins-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/layouts/layout4/css/layout-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/layouts/layout4/css/themes/default-rtl.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('/admin_ui/assets/layouts/layout4/css/custom-rtl.min.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-database.js"></script>
    <style type="text/css">
        .alerts-list{
            list-style: none;
        }
        .sweet-alert {
            z-index: 1000000000;
            border: solid 3px #42a1d5;
        }
    </style>
@yield('styles')
<!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{ url('/adminpanel') }}">
                <img src="{{ asset('/admin_ui/logo.png')}}" style="width: 144px;margin: 4px !important;margin: 4px !important;" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                        <a href="javascript:;" class="seenNotification dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-success"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <ul id="notificationList" class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283"></ul>
                            </li>
                        </ul>
                    </li>
                    <li class="separator hide"> </li>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            @if (is_file('admin_ui/'.Auth::id().'.png'))
                                <img src="{{ asset('/admin_ui/'.Auth::id().'.png')}}" class="img-responsive" alt="No Image">
                            @else
                                <img src="{{ asset('/admin_ui/Admin.png')}}" class="img-responsive" alt="No Image">
                            @endif

                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ url('profile',Auth::user()->name) }}">
                                    <i class="icon-user"></i> بروفايلي </a>
                            </li>
                            <li>
                                <a onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
                                    <i class="icon-key"></i> تسجيل الخروج </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                @include('admin_layouts.menu')
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>@yield('header')
                        <small>@yield('head_description')</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
        {{--<ul class="page-breadcrumb breadcrumb">--}}
        {{--<li>--}}
        {{--<a href="{{ url('/') }}">الرئيسية</a>--}}
        {{--<i class="fa fa-circle"></i>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<span class="active">@yield('breadcrumb')</span>--}}
        {{--</li>--}}
        {{--</ul>--}}
        <!-- END PAGE BREADCRUMB -->
            @yield('content')
            <span id="users"></span>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <a href="javascript:;" class="page-quick-sidebar-toggler">
        <i class="icon-login"></i>
    </a>
    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="copyright"> ©2019, صون, جميع الحقوق محفوظه. </div>
</div>
@include('orders.editOrder')
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="assignCompany" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> اختيار شركة للطلب</h4>
            </div>
            <form role="form" method="POST" class="assignForm" action="{{ url('/assign-company-orders') }}" data-toggle="validator">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleInputPassword1">رقم الطلب</label>
                            <input id="orderId" type="hidden"  name="order_id" required class="form-control">
                            <span class="help-block with-errors errorName"></span>
                        </div>

                        <label for="exampleInputFile"> الشركة</label>
                        <select required  class="form-control" id="company_id" name="company_id">
                            <option selected value="">أختر الشركة </option>
                            @if(count($companies) > 0)
                            @foreach($companies as $company)
                                <option value="{!! $company->id !!}">{!! $company->name !!}</option>
                            @endforeach
                                @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="assignCompanyOrder" class="btn btn-primary">اختيار</button>
                    <button type="button" class="btn btn-danger closeModal">غلق</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addService" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> اختيار شركة للطلب</h4>
            </div>
            <form role="form" method="POST" class="addForm" action="{{ url('/add-service') }}" data-toggle="validator">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" class="application_id" name="orderId" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFile"> نوع المكيف</label>
                        <select id="airTypeId" required  class="form-control" name="air_type_id">
                            <option selected value="">أختر النوع </option>
                            @foreach($airTypes as $airType)
                                <option value="{!! $airType->id !!}">{!! $airType->type !!}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile"> نوع الخدمه</label>
                        <select id="serviceId" required  class="form-control" name="service_id">
                            <option selected value="">أختر النوع </option>
                            @foreach($serviceTypes as $service)
                                <option value="{!! $service->id !!}">{!! $service->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">عدد المكيفات</label>
                        <input id="numberAir" type="number" min="1" name="number" required class="form-control">
                        <span class="help-block with-errors errorName"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">موافق</button>
                    <button type="button" class="btn btn-danger closeModal">غلق</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false"  id="getOrderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times<i class="fas fa-times"></i></span></button>
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i>  ملخص الطلب</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="invoiceDetails">
                                    <thead>
                                    <th class="col-md-1"> الخدمه</th>
                                    <th class="col-md-1">نوع المكيف</th>
                                    <th class="col-md-1">عدد المكيفات</th>
                                    </thead>
                                    <tbody id="getOrderDetails"></tbody>
                                </table>
                                <form role="form" method="POST" class="addInvoiceForm" action="{{ url('/add-invoice') }}" data-toggle="validator">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">الأجمالي</label>
                                    <input id="invoiceAmount" type="text" name="amount" required class="form-control">
                                    <span class="help-block with-errors errorName"></span>
                                </div>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تصدير فاتورة</button>
                <button type="button" class="btn btn-danger closeModal">غلق</button>

            </div>
        </div>
        </div>
    </div>
</div>

<!-- END FOOTER -->
<div class="quick-nav-overlay"></div>
<script src="{{ asset('/admin_ui/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
{{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>--}}
<script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/code-ui.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/application.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/bootbox.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/forms.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/validator.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>

<script src="{{ asset('/admin_ui/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>

<script src="{{ asset('/admin_ui/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/pages/scripts/table-datatables-colreorder.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/admin_ui/assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
<script>
    function changeOrderStatus(status, id) {
        if(status == 'Hanging'){
            var reason = window.prompt("سبب التعليق ", "");
            if(reason){
                jQuery.ajax({
                    url: "chnage-order-status/" + id + "/" + status + "/" + reason,
                    type: "GET",
                    success: function(res){
                        $('.HangingOrders').html( 'جديد' );
                        swal({
                            title: "تم تحديث حالة الطلب بنجاح",
                            type: "success",
                            closeOnConfirm: false,
                            confirmButtonText: "موافق !",
                            confirmButtonColor: "#ec6c62",
                            allowOutsideClick: true
                        });
                        oTable.draw();
                    },
                    error: function(){
                    }
                });
            }
        }
        else if (window.confirm(" هل أنت متأكد من تغير حالة الطلب ؟"))
        {
            $.ajax({
                url: "chnage-order-status/" + id + "/" + status,
                type: "GET",
                success: function(res){
                    if(status == 'Pending')
                        $('.pendingOrders').html( 'جديد' );
                    else if(status == 'Accepted')
                        $('.AcceptedOrders').html( 'جديد' );
                    else if(status == 'Completed')
                        $('.CompletedOrders').html( 'جديد' );
                    else if(status == 'Hanging')
                        $('.HangingOrders').html( 'جديد' );
                    else if(status == 'Cancelled')
                        $('.CancelledOrders').html( 'جديد' );
                    else if(status == 'Under_Appraisal')
                        $('.Under_AppraisalOrders').html( 'جديد' );
                    swal({
                        title: "تم تحديث حالة الطلب بنجاح",
                        type: "success",
                        closeOnConfirm: false,
                        confirmButtonText: "موافق !",
                        confirmButtonColor: "#ec6c62",
                        allowOutsideClick: true
                    });
                    oTable.draw();
                },
                error: function(){
                }
            });
        }
    }

    function getOrderDetails(id) {
        var self = $(this);
        self.button('loading');
        $.ajax({
            url: "get-order-details/" + id ,
            type: "GET",
            success: function(res){
                self.button('reset');
                $('#getOrderDetails').html(res);
                $('#invoiceDetails').DataTable({ retrieve: true, language: {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json"
                    }});
                $('#getOrderDetailsModal input').val("");
                $('#getOrderDetailsModal form').attr("data-id", id);
                $('#getOrderDetailsModal').modal('show');

            },
            error: function(){
                self.button('reset');
            }
        });
    }

    $(document).ready(function() {
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyAlluSsItpKg4GaXSNa1bbO8ED50FxYTxU",
            authDomain: "swan-app-caa56.firebaseapp.com",
            databaseURL: "https://swan-app-caa56.firebaseio.com",
            projectId: "swan-app-caa56",
            storageBucket: "swan-app-caa56.appspot.com",
            messagingSenderId: "711247139214",
            appId: "1:711247139214:web:094a0e7c85a8d547"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const users = document.getElementById('users');
        const list = document.getElementById('notificationList');
        const dbRefUsers = firebase.database().ref().child('users');
        const dbRefCounter = dbRefUsers.child('{!! Auth::user()->id !!}'+ '/counter');
        const dbRefNotifications = dbRefUsers.child('{!! Auth::user()->id !!}' + '/notifications').orderByChild('id');
        dbRefNotifications.on('child_added', snap => {
            $('.noNotificationFound').hide();
            console.table(snap.val());
            $('#notificationList').prepend('<'+'li class="NotificationFound"'+'><'+'a href="'+snap.val().url+'"'+'><'+'span class="time" style="max-width: 88px;"'+'>'+snap.val().created_at+'<'+'/span'+'> <'+'span class="details"'+'><'+'span class="label label-sm label-icon label-success"'+'><'+'i class="fa fa-dot-circle-o"'+'><'+'/i'+'><'+'/span'+'>'+snap.val().text +'.' +'<'+'/span'+'><'+'/a'+'><'+'/li'+'>');
        });
        dbRefCounter.on('value', snap => {
            if(JSON.stringify(snap.val(), 0 ,3) !== 'null'){
                $('.badge').html(JSON.stringify(snap.val(), 0 ,3));
            }
            else{
                $('.badge').html(0);
                $('.NotificationFound').hide();
                $('#notificationList').append('<'+'li class="noNotificationFound"'+'><'+'a href="javascript:;"'+'><'+'span class="details"'+'><'+'span class="label label-sm label-icon label-success"'+'><'+'i class="fa fa-dot-circle-o"'+'><'+'/i'+'><'+'/span'+'>'+'لا يوجد أشعارات' +'.' +'<'+'/span'+'><'+'/a'+'><'+'/li'+'>');
            }
        });

        $('body').on('click', '.image', function () {
            var dialog = bootbox.dialog({
                message: '<img style="height:500px; width:100%" src="' + $(this).attr('src') + '"/>',
                buttons: {
                    cancel: {
                        label: "غلق",
                        className: 'text-right btn-primary'
                    }
                }
            });
        });

        function populateForm(response, frm) {
            var i;
            for (i in response) {
                if (i in frm.elements)
                    frm.elements[i].value = response[i];
            }
        }

        $(document.body).validator().on('click', '.changePassword2', function() {
            var self = $(this);
            self.button('loading');
            $('#changePasswordModal form').attr("data-id", self.data('id') );
            $('#changePasswordModal').modal('show');
            self.button('reset');

        });

        $(document.body).validator().on('click', '.hideAirService', function() {
            var self = $(this);
            $.ajax({
                url: "delete-air-service-type/" + self.data('id'),
                type: "get",
                success: function(res){
                    self.closest('.hideRow').hide()
                },
                error: function(error){
                }
            });
        });

        $(document.body).validator().on('click', '.seenNotification', function() {
            $.ajax({
                url: "update-notifications-seen/" + '{!! Auth::user()->id !!}',
                type: "get",
                success: function(res){
                    $('.badge').html(0);
                },
                error: function(error){
                }
            });
        });

        $(document.body).validator().on('click', '.assignCompany', function() {
            var self = $(this);
            self.button('loading');
            $('#assignCompany form').attr("data-id", self.data('id') );
            $('#orderId').val(self.data('id'));
            $('#assignCompany').modal('show');
            self.button('reset');

        });

        $(document.body).validator().on('click', '.addService', function() {
            var self = $(this);
            self.button('loading');
            $('#addService form').attr("data-id", self.data('id') );
            $('.application_id').val(self.data('id') );
            $('#addService').modal('show');
            self.button('reset');

        });

        $("#assignCompany form").on('submit', function(e){
            if (!e.isDefaultPrevented())
            {
                var self = $(this);
                $.ajax({
                    url: self.closest('form').attr('action'),
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        order_id:$('#orderId').val(),
                        company_id:$('#company_id').val()
                    },
                    beforeSend: function(){
                        if ($('#company_id').val() == "")
                            return false;
                    },
                    success: function(res){
                        $('.assignForm')[0].reset();
                        $('#assignCompany').modal('hide');
                        swal({
                            title: "تم أختيار شركة بنجاح",
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
        $("#addService form").on('submit', function(e){
            if (!e.isDefaultPrevented())
            {
                var self = $(this);
                $.ajax({
                    url: self.closest('form').attr('action'),
                    type: "POST",
                    data: self.serialize(),
                    beforeSend: function(){
                        if ($('#airTypeId').val() == "" || $('#serviceId').val() == "" || $('#numberAir').val() == "")
                            return false;
                    },
                    success: function(res){
                        $('.addForm')[0].reset();
                        $('#addService').modal('hide');
                        swal({
                            title: "تم أضافة خدمة بنجاح",
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

        $("#getOrderDetailsModal form").on('submit', function(e){
            if (!e.isDefaultPrevented())
            {
                var self = $(this);
                $.ajax({
                    url: self.closest('form').attr('action') +"/" + self.data('id'),
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: self.serialize(),
                    beforeSend: function(){
                        if (isNaN($('#invoiceAmount').val()) || $('#invoiceAmount').val() == "")
                            return false;
                    },
                    success: function(res){
                        $('.addForm')[0].reset();
                        $('#getOrderDetailsModal').modal('hide');
                        swal({
                            title: "تم تصدير فاتورة بنجاح",
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

        $(document.body).validator().on('click', '.edit', function() {
            var self = $(this);
            self.button('loading');
            $.ajax({
                url: "{{ url($modal) }}" + "/" + self.data('id') + "/edit" ,
                type: "GET",
                success: function(res){
                    self.button('reset');
                    $data = JSON.parse(res.data);
                    populateForm($data, document.getElementsByClassName("editForm")[0] );
                    $('#editModal form').attr("data-id", self.data('id') );
                    $('#editModal').modal('show');
                },
                error: function(){
                    self.button('reset');
                    $('.alerts-list').append(
                        '<li>\
                        <div class="alert alert-danger alert-dismissable">\
                        <i class="icon-remove-sign"></i> <strong>Opps!</strong>حدث خطأ.\
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                        </div>\
                        </li>');
                }
            });
        });
        $(document.body).validator().on('click', '.editOrder', function() {
            var self = $(this);
            self.button('loading');
                $.ajax({
                    url: "{{ url($modal) }}" + "/" + self.data('id') + "/edit" ,
                    type: "GET",
                    success: function(res){
                        self.button('reset');
                        $('#editModalOrder form').attr("data-id", self.data('id') );
                        $('.orderData').html(res);
                        $('#editModalOrder').modal('show');
                    },
                    error: function(){
                        self.button('reset');
                        $('.alerts-list').append(
                            '<li>\
                            <div class="alert alert-danger alert-dismissable">\
                            <i class="icon-remove-sign"></i> <strong>Opps!</strong>حدث خطأ.\
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                            </div>\
                            </li>');
                    }
                });
        });

        $("#editModalOrder form").validator().on('submit', function(e){
            if (!e.isDefaultPrevented())
            {
                var self = $(this);
                var air_types = getCheckedBoxes("airType");
                var service_types = getCheckedBoxes("serviceType");
                var numbers = getNumbers("number");
                var jsonStringAirTypes = JSON.stringify(air_types);
                var jsonStringServiceTypes = JSON.stringify(service_types);
                var jsonStringNumbers = JSON.stringify(numbers);
                if(air_types == null || service_types == null){
                    alert('من فضلك أختر اختيار علي الأقل');
                    return false;
                }else{
                    if($('.hideRow').css('display') == 'none'){
                        $('.airTypes').val(null);
                        $('.serviceTypes').val(null);
                        $('.numbers').val(null);
                    }else{
                        $('.airTypes').val(jsonStringAirTypes);
                        $('.serviceTypes').val(jsonStringServiceTypes);
                        $('.numbers').val(jsonStringNumbers);
                    }
                    $.ajax({
                        url: self.closest('form').attr('action') + "/" +  self.attr("data-id"),
                        type: "POST",
                        data: "_method=PUT&" + self.serialize(),
                        success: function(res){
                            $('#editModalOrder').modal('hide');
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
            }
        });

        $('#clickmewow').click(function(){
            $('#radio1003').attr('checked', 'checked');
        });

        $('.closeModal').click(function(){
            $('.modal').modal('hide');
        });

        function getCheckedBoxes(chkboxName) {
            var checkboxes = document.getElementsByClassName(chkboxName);
            var checkboxesChecked = [];
            // loop over them all
            for (var i=0; i<checkboxes.length; i++) {
                // And stick the checked ones onto an array...
                if (checkboxes[i].checked) {
                    checkboxesChecked.push(checkboxes[i].value);
                }
            }
            // Return the array if it is non-empty, or null
            return checkboxesChecked.length > 0 ? checkboxesChecked : null;
        }

        function getNumbers(inputName) {
            var numbers = document.getElementsByName(inputName);
            var checkboxesChecked = [];
            // loop over them all
            for (var i=0; i<numbers.length; i++) {
                // And stick the checked ones onto an array...
                checkboxesChecked.push(numbers[i].value);
            }
            // Return the array if it is non-empty, or null
            return checkboxesChecked.length > 0 ? checkboxesChecked : null;
        }

    })

</script>

@yield('scripts')
</body>

</html>