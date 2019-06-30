@extends('front.layout')
@section('title','فحص حالة الطلب')
@section('content')
 
            <div class='main_color container_wrap_first container_wrap fullsize'>
                <div class='container'>
                    <main role="main" itemprop="mainContentOfPage" class='template-page content  av-content-full alpha units'>
                        <div class='post-entry post-entry-type-page post-entry-271'>
                            <div class='entry-content-wrapper clearfix'>
								<div class="flex_column av_one_full  av-animated-generic bottom-to-top  flex_column_div av-zero-column-padding first  avia-builder-el-0  avia-builder-el-no-sibling   avia_start_animation avia_start_delayed_animation" style="border-radius:0px; "><section class="av_textblock_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork"><div class="avia_textblock " itemprop="text"><div class="check-order-status">
									<div class="meta">
										<h2>متابعة حالة الطلب</h2>
									</div>
								<div class="co_order_status co-normal co-success" style="">
								<div class="ordersWrapper">
									<div class="avia-data-table-wrap avia_responsive_table table-content">
										<p class="foundOrders">قائمة طلباتكم: </p>
										<table class="ordersTable avia-table avia-data-table">
											<thead>
												<tr>
													<th>رقم الطلب #</th>
													<th>نوع المكيف</th>
													<th>نوع الخدمة</th>
													<th>اليوم</th>
													<th>الحي</th>
													<th>حالة الطلب</th>
												</tr>
											</thead>
											<tbody>
											@foreach($applications as $application)
												<tr class="gray">
													<td class="first-mobile">رقم الطلب #{{ $application->id }}</td>
													<td>
														<ul>
														@foreach($application->getAirTypes as $type)
																<li>{{ $type->type }}</li>
														@endforeach
														</ul>
													</td>
													<td>
														<ul>
															@foreach($application->getServiceTypes as $service)
																<li>{{ $service->name }}</li>
															@endforeach
														</ul>
														 {{--<span style="color: #BBBBBB;font-size: 11px;">(يبدأ من 100 ريال)</span> --}}
													</td>
													<td>
														{{ $application->day  .' '. date("g:i a", strtotime($application->getHour->hour))}}
													</td>
													<td>
														{{ $application->region }}
													</td>
													<td>
														@if($application->status == 'Completed')
															<span class="pstatus pstatus-done">منفذ بنجاح</span>
														@elseif($application->status == 'Accepted')
															<img class="cancel-order" style="display: none; height: 76px;" src="{{ asset('admin_ui/giphy.gif')}}">
															<div class="xx">
															<span class="pstatus pstatus-verification">معتمد  </span>
															<a href="#"  onclick="cancelOrder('Cancelled', {{$application->id}})">الغاء الطلب؟</a>
															</div>
														@elseif($application->status == 'Cancelled')
															<span class="pstatus pstatus-trash">سلة المهملات</span>
														@elseif($application->status == 'Pending')
															<span class="pstatus pstatus-pending">جديد</span>
														@elseif($application->status == 'Under_Appraisal')
															<span class="pstatus pstatus-Under_Appraisal">تحت التقييم</span>
														@elseif($application->status == 'Hanging')
															<span class="pstatus pstatus-Hanging">معلق</span>
														@elseif($application->status == 'Sms_Not_Confirmed')
															<span class="pstatus pstatus-Sms_Not_Confirmed">لم يتحقق من رقم الجوال</span>
														@endif
													</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
    <div class="steps">
        <div class="step1">
            
        </div>
        <div class="step2">

        </div>
    </div>
</div>
</div></section></div>

</div>
                            </div>
                        </div>
                    </main>
                    <!-- close content main element -->
                    <!-- section close by builder template -->
                </div>
@endsection