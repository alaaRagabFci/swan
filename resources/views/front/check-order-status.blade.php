@extends('front.layout')
@section('title','فحص حالة الطلب')
@section('content')
        <div id='main' data-scroll-offset='0'>

            <div class='main_color container_wrap_first container_wrap fullsize'>
                <div class='container'>
                    <main role="main" itemprop="mainContentOfPage" class='template-page content  av-content-full alpha units'>
                        <div class='post-entry post-entry-type-page post-entry-271'>
                            <div class='entry-content-wrapper clearfix'>
                                <div class="flex_column av_one_full  av-animated-generic bottom-to-top  flex_column_div av-zero-column-padding first  avia-builder-el-0  avia-builder-el-no-sibling  " style='border-radius:0px; '>
                                    <section class="av_textblock_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
                                        <div class='avia_textblock ' itemprop="text">
                                            <div class="check-order-status">
                                                <div class="steps col-md-8 col-md-offset-2">
													<div class="meta">
														<h2>متابعة حالة الطلب</h2>
													</div>
                                                    <div class="step1">
                                                        @if (\Session::has('message'))
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    <li style="text-align: center; list-style: none">{!! \Session::get('message') !!}</li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <form class="co-form-status" action="{{ url('check-phone') }}" method="GET">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="form-row">
                                                                <p>رقم الجوال:</p>
                                                                <input type="text" value="{{ old('phone') }}" required name="phone" id="co_mobile" placeholder="رقم الجوال مثال:  05xxxxxxxx" />
                                                            </div>
                                                            <div class="form-row">
                                                                <button type="submit" class="submitbtn" id="do_check_order_status">تابع حالة الطلب!</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- close content main element -->
                    <!-- section close by builder template -->
                </div>
                <!--end builder template-->
            </div>
 
@endsection