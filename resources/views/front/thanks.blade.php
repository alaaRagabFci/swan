@extends('front.layout')
@section('title','شكرا!!')
@section('content')
        <div id='main' data-scroll-offset='0'>

            <div class='main_color container_wrap_first container_wrap fullsize'>
                <div class='container'>
                    <main role="main" itemprop="mainContentOfPage" class='template-page content  av-content-full alpha units'>
                        <div class='post-entry post-entry-type-page post-entry-271'>
                            <div class='col-sm-8 col-sm-offset-2'>
								<div class=''>
									<div style='padding-bottom:10px;' class='av-special-heading av-special-heading-h3    avia-builder-el-1  el_before_av_notification  avia-builder-el-first  '>
										<h3 class='av-special-heading-tag' itemprop="headline">  فاتورة طلب {{ $invoiceTotal->invoice_number }}</h3>
										<div class='special-heading-border'>
											<div class='special-heading-inner-border'></div>
										</div>
									</div>
									<div class="vote_form">
										<!-- <h4 class=''>  شكرًا لطلبك خدماتنا من صون   </h4> -->
										<p>
										شكرًا لطلبك خدماتنا من صون <br/>
										رقم طلبك <span class="order_num">{{ $id }}</span>
										</p>
										<div class="custyle">
											<div class='table-content'>
												<p>تفاصيل الطلب:</p>
												<table class="table table-striped custab">
													<thead>
														 <tr>
															<th>نوع المكيف</th>
															<th>الخدمة</th>
															<th>العدد</th>
														 </tr>
													</thead>
													<tbody>
													@foreach($application as $app)
														<tr>
															<td>{{ $app->getAirType->type }} </td>
															<td>{{ $app->getService->name }} </td>
															<td> {{ $app->number }}  </td>
														 </tr>
														@endforeach
													</tbody>
													<tfoot>
														<tr>
															<th colspan="2"  class="text-center">
																الإجمالي  
															</th>
															 
															<th class="text-center">{{ $invoiceTotal->amount }} </th>
														</tr>
													</tfoot>
												</table>
											</div>
											@if (\Session::has('message'))
												<div class="alert alert-success">
													<ul>
														<li style="text-align: center; list-style: none">{!! \Session::get('message') !!}</li>
													</ul>
												</div>
											@endif
											@if(!$getRate)
											<div class="vote_points">
												<h5 style="font-weight: bold;">كيف تقيم تجربتك؟  <span style='color: #BBBBBB;font-size: 13px;font-weight: normal;'>(في حال تقييمك , سيتم منحك ضمان شهر كامل   )</span>  </h5>
												<form class="service_evaluate" method="post" action = "{{ url('/rateApplication') }}">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<div class="form-row">
														<p style="font-weight: bold;">تجربتك للخدمة</p>
														<div id="element"></div> 
														<p class="nums"><span name="rate">1</span>
														<span>2</span>
														<span>3</span>
														<span>4</span>
														<span>5</span></p>
													 </div>
													<input type="hidden" value="{{ $id }}" name="orderId">
													 <div class='row'>
														 <div class="form-row col-md-12">
															<p style="font-weight: bold;">تعليقاتك</p>
															<textarea required name="comment" class="form-ctrl" id="" cols="30" rows="10"></textarea>
														</div>
													</div>
													<p class="order_note">(لملاحظاتك على الفاتورة , الرجاء التواصل على الرقم التالي : {{ $setting->phone }}  )</p>
													<div class="form-row">
														<button type="submit" id="verifysmsbtn" class="submitbtn avia-button  avia-icon_select-no avia-color-silver avia-size-medium ">تأكيد</button>
													</div>
												</form>
											</div>
											@endif
										</div>
									</div>
								</div>
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

