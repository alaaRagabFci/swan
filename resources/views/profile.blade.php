@extends('admin_layouts.inc')

@section('title','بروفايل الأدمن')
@section('header','بروفايل الأدمن')
@section('head_description','أعدادات حسابك')
@section('breadcrumb','بروفايلي')
@section('styles')
    <link href="{{ asset('/admin_ui/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin_ui/assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet bordered">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        @if (is_file('admin_ui/'.Auth::id().'.png'))
                            <img src="{{ asset('/admin_ui/'.Auth::id().'.png')}}" class="img-responsive" alt="No Image">
                        @else
                            <img src="{{ asset('/admin_ui/Admin.png')}}" class="img-responsive" alt="No Image">
                        @endif
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{ Auth::user()->name }} </div>
                        <div class="profile-usertitle-job"> الأدمن </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">الحساب الشخصي</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">البيانات الشخصيه</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">تغير صورة البروفايل</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">تغير الباسورد</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                @if(session('flag') == 1)
                                    <div class="alert alert-info" role="alert" id="success_message"> {{session('msg')}} </div>
                                @endif
                                @if (count($errors) > 0)
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <span> {{ $error }}. </span>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form role="form" action="{{ url('/updateUser') }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <label class="control-label">الأسم</label>
                                                <input type="text" required name="name" value="{{ $info->name }}" placeholder="John" class="form-control" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">البريد الألكتروني</label>
                                                <input type="email" required name="email" value="{{ $info->email }}" placeholder="email" class="form-control" /> </div>
                                            <div class="margiv-top-10">
                                                <button type="Submit" class="btn green">حفظ المتغيرات</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE AVATAR TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <form enctype="multipart/form-data" action="{{ url('/setAvatar') }}" method="POST" role="form">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="{{ asset('/admin_ui/'.Auth::id().'.png')}}" alt="" /> </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                    <div>
                        <span class="btn default btn-file">
                            <span class="fileinput-new"> اختر صوره </span>
                            <span class="fileinput-exists"> تغير </span>
                            <input type="file" name="profile_image" required> </span>
                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="margin-top-10">
                                                <button type="Submit" class="btn green">تغير</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE AVATAR TAB -->
                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_3">
                                        <form action="{{ url('/set_password') }}" method="POST" >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <label class="control-label">الرقم السري الحالي</label>
                                                <input type="password" required name="old_pass" class="form-control" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">الرقم السري الجديد</label>
                                                <input type="password" required name="new_pass" class="form-control" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">أعد كتابة الرقم السري</label>
                                                <input type="password" required class="form-control" /> </div>
                                            <div class="margin-top-10">
                                                <button type="Submit" class="btn green">تغير</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/admin_ui/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/admin_ui/assets/pages/scripts/profile.min.js')}}" type="text/javascript"></script>
@endsection