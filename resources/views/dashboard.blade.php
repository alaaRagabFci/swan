@extends('admin_layouts.inc')

@section('title','لوحة التحكم')
@section('header','لوحة التحكم')
@section('head_description','الأحصائيات, الأشكال البيانيه والتقرير')
@section('breadcrumb','لوحة التحكم')
@section('content')
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        @if(Auth::user()->type == "Admin")
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                              <a href="javascript:;">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                        <span data-counter="counterup" data-value="{{ $applicationCompleted }}"></span>
                                        </h3>
                                        <small>الطلبات المكتملة</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{ $applicationCompleted }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $applicationCompleted }}%</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-number"> {{ $applicationCompleted }}% </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a href="javascript:;">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                        <span data-counter="counterup" data-value="{{ $applicationCancelled }}"></span>
                                        </h3>
                                        <small>الطلبات الملغية</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{ $applicationCancelled }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $applicationCancelled }}%</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-number"> {{ $applicationCancelled }}% </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a href="javascript:;">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                          <span data-counter="counterup" data-value="{{ $categories }}"></span>
                                        </h3>
                                        <small>فئات الشركات</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                                 <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{ $categories }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $categories }}%</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-number"> {{ $categories }}% </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                        @else
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a href="javascript:;">
                                    <div class="dashboard-stat2 bordered">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-green-sharp">
                                                    <span data-counter="counterup" data-value="{{ $applicationCompanyCompleted }}"></span>
                                                </h3>
                                                <small>الطلبات المكتملة</small>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                        <span style="width: {{ $applicationCompanyCompleted }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $applicationCompanyCompleted }}%</span>
                                        </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-number"> {{ $applicationCompanyCompleted }}% </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a href="javascript:;">
                                    <div class="dashboard-stat2 bordered">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-red-haze">
                                                    <span data-counter="counterup" data-value="{{ $applicationCompanyPending }}"></span>
                                                </h3>
                                                <small>الطلبات الجديده</small>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                        <span style="width: {{ $applicationCompanyPending }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $applicationCompanyPending }}%</span>
                                        </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-number"> {{ $applicationCompanyPending }}% </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a href="javascript:;">
                                    <div class="dashboard-stat2 bordered">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-purple-soft">
                                                    <span data-counter="counterup" data-value="{{ $teams }}"></span>
                                                </h3>
                                                <small>فريق العمل</small>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-male"></i>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                        <span style="width: {{ $teams }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $teams }}%</span>
                                        </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-number"> {{ $teams }}% </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a href="javascript:;">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="{{ $services }}"></span>
                                        </h3>
                                        <small>الخدمات</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-server"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{ $services }}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{ $services }}%</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-number"> {{ $services }}% </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    <!-- END PAGE BASE CONTENT -->
@endsection