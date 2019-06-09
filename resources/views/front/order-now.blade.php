@extends('front.layout')
@section('title','أطلب الأن')
@section('content')
<div id='main' data-scroll-offset='0'>

<div class='main_color container_wrap_first container_wrap fullsize'>
<div class='container'>
<main role="main" itemprop="mainContentOfPage" class='template-page content  av-content-full alpha units'>
<div class='post-entry post-entry-type-page post-entry-269'>
<div class='entry-content-wrapper clearfix'>
<div class="flex_column av_one_full  av-animated-generic bottom-to-top  flex_column_div av-zero-column-padding first  avia-builder-el-0  avia-builder-el-no-sibling  " style='border-radius:0px; '>
<div style='padding-bottom:10px;' class='av-special-heading av-special-heading-h3    avia-builder-el-1  el_before_av_notification  avia-builder-el-first  '>
	<h3 class='av-special-heading-tag' itemprop="headline">تقديم طلب جديد</h3>
	<div class='special-heading-border'>
		<div class='special-heading-inner-border'></div>
	</div>
</div>
<div class='avia_message_box avia-color-orange avia-size-normal avia-icon_select-yes avia-border-  avia-builder-el-2  el_after_av_heading  el_before_av_textblock '>
	<div class='avia_message_box_content'><span class='avia_message_box_icon' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></span>
		<p>بسطناها، دقيقة واحدة تكفي لتقديم الطلب 😉</p>
	</div>
</div>
<section class="av_textblock_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
	<div class='avia_textblock ' itemprop="text">
		<div class="co-order-form">
			<div class="step1">
				<div class="co_order_status" style="display: none"></div>
				<form class="orderNow co-form row" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" class="airTypes" name="airTypes" value="">
					<input type="hidden" class="serviceTypes" name="serviceTypes" value="">
					<input type="hidden" class="numbers" name="numbers" value="">
					<div class='col-sm-6'>
						<div class="form-row">
							<p style="font-weight: bold;">الاسم</p>
							<input required type="text" class="form-ctrl" id="co_name" name="name" placeholder="الاسم" />
						</div>
					</div>

					<div class='col-sm-6'>
						<div class="form-row">
							<p style="font-weight: bold;">رقم الجوال</p>
							<input required type="text" class="orderPhone form-ctrl" id="co_mobile" name="phone" placeholder="رقم الجوال مثال:  05xxxxxxxx" />
						</div>
					</div>
					<div class='col-sm-12'>
						<div class="co_information_cont">
							<div class="co_info cloneThis set">
								<div class="form-row co_type">
									<h3 class='first-heading'> نوع المكيف </h3>
									@foreach($airTypes as $type)
									<div class="pretty p-default p-round">
										<input required type="radio" name="air_type_id" value="{{ $type->id }}" class="co_conditioners_type" data-name="{{ $type->type }}" data-id="{{ $type->id }}" />
										<div class="state p-warning-o">
											<label>{{ $type->type }}</label>
										</div>
									</div>
									<br/>
									@endforeach
								</div>

								<div class="form-row hide co_service_type">
									<h4 class='heading-type-ser'>نوع الخدمة</h4>
									<p  class='para1'>الأسعار تقريبية وتختلف بحسب عدد المكيفات ونوعها</p>
									@foreach($services as $service)
									<div class="pretty p-default p-round">
										<input required type="radio" name="service_id" value="{{ $service->id }}" class="co_service" data-name="{{ $service->name }}" data-id="{{ $service->id }}" />
										<div class="state p-warning-o">
											<label>{{ $service->name }}</label>
										</div>
									</div>
									<br/>
									@endforeach
								</div>

								<div class="form-row hide co_numbers">
									<h4 class='heading-type-ser'>عدد المكيفات</h4>
									<p class="para1"> في حال كان العدد أقل من 3 مكيفات فإن الفاتورة لن تقل عن 330 ريال.</p>
									<select style="width:90%;" name="number" class="co_conditioners_number">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
								</div>

							</div>
							<div class="form-row hide more_co">
								<p class='txt-more'>مزيد من المكيفات؟  </p>
								<div id=" " class="more_co_btn avia-button  avia-icon_select-no avia-color-silver avia-size-medium  ">اضافة نوع مكيف جديد </div>
							</div>
						</div>

					</div>

					<div class="col-sm-12">
						<div class="othersDetails hide">

							<div class="form-row overflow">
								<div class="co_date_cont width_50">
									<p style="font-weight: bold;">اليوم</p>
									<input required type="text" style="width:80%;"  name="day" id="co_date" data-toggle="datepicker">
								</div>
								<div class=" co_time_cont width_50">
									<p style="font-weight: bold;">الوقت</p>
									<select  required style="width:80%;" name="hour_id" id="co_time">
										@foreach($hours as $hour)
										<option value="{{ $hour->id }}">{{date("g:i a", strtotime( $hour->hour))}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="overflow">
								<div class="width_50">
									<p style="font-weight: bold;">المدينة</p>
									<input required type="text"  style="width:80%; margin-bottom:0" class="form-ctrl" id="co_city" name="co_city" placeholder="الرياض" readonly/>
									<span style="color: #BBBBBB;font-size: 11px;">فقط في مدينة الرياض حالياً</span>
								</div>
								<div class="width_50 ">
									<p style="font-weight: bold;">الحي</p>
									<select required style="width:80%;" name="region_id" id="co_time">
										@foreach($regions as $region)
											<option value="{{ $region->id }}">{{ $region->name }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<input type="hidden" id="cptxdis" value="cdisbl">
							<div class="form-row">
								<div id="co_test" class="summBtn avia-button   avia-icon_select-no   avia-size-medium  ">ملخص الطلب  </div>
								<button id="co_submit_form" class="submitbtn avia-button   avia-icon_select-no avia-color-silver avia-size-medium  ">تقديم الطلب</button>
							</div>



						</div>
						<div class="order_summery hide ">
							<div class='table-content'>
								<p>ملخص الطلب:</p>
								<table class="table table-striped custab summTable">
									<thead>
									<tr>
										<th>نوع المكيف</th>
										<th>الخدمة</th>
										<th>العدد</th>
										<th>تكلفة الوحدة<br/> (تقريبي)</th>
										<th>الإجمالي <br/> (تقريبي)</th>
									</tr>
									</thead>
									<tbody>


									</tbody>

								</table>
							</div>
						</div>
					</div>


				</form>
			</div>
			<div class="step2" style="display: none">
				<div class="verifymsgs" style="display: none"></div>
				<form class="verifyNumber" id="verify-sms" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-row">
						<h3>التحقق من رقم الجوال</h3>
						<p>نرجو إدخال الرقم المرسل إلى جوالكم والمكون من 6 أرقام</p>
						<p class="errorVerify" style="display:none; color: red; font-size: 18px; font-weight: bold;">تأكد من الكود!!</p>
					</div>
					<div class="form-row">
						<input type="text" required name="confirmation_code" id="co_verification_code" placeholder="أدخل رقم التحقق هنا" />
						<input type="hidden" name="order_id" id="co_order_id" value="-1" />
					</div>
					<div class="form-row">
						<button id="verifysmsbtn" class="submitbtn">تأكيد</button>
					</div>
				</form>

			</div>
		</div>
		<div style="display: none" class='avia_message_box avia-color-success avia-size-normal avia-icon_select-yes avia-border-  avia-builder-el-2  el_after_av_heading  el_before_av_textblock '>
			<div class=''><span class='avia_message_box_icon' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></span>
				<p> تم أرسال طلبك بنجـــــاح!!</p>
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
@section('scripts')
<script>
	$(".verifyNumber").on('submit', function(e){
		if (!e.isDefaultPrevented())
		{
			var self = $(this);
			$.ajax({
					url: "verify-number",
					type: "POST",
					data: self.serialize(),
					success: function(res){
						//redirect to confirmation code page
						$('.step2').hide();
						$('.avia_message_box').show();
					},
					error: function(error){
						$('.errorVerify').show();
					}
				});
			e.preventDefault();
		}
	});

	$(".orderNow").on('submit', function(e){
		if (!e.isDefaultPrevented())
		{
			var self = $(this);
			var air_types = getCheckedBoxes("co_conditioners_type");
			var service_types = getCheckedBoxes("co_service");
			var numbers = getNumbers("number");
			var jsonStringAirTypes = JSON.stringify(air_types);
			var jsonStringServiceTypes = JSON.stringify(service_types);
			var jsonStringNumbers = JSON.stringify(numbers);
			if(air_types == null || service_types == null){
				alert('من فضلك أختر اختيار علي الأقل');
				return false;
			}else{
				$('.airTypes').val(jsonStringAirTypes);
				$('.serviceTypes').val(jsonStringServiceTypes);
				$('.numbers').val(jsonStringNumbers);
				$.ajax({
					url: "order-now",
					type: "POST",
					data: self.serialize(),
					success: function(res){
						if(res['redirect']){
							//redirect to confirmation code page
							$('#co_order_id').val(res['msg']['id']);
							$('.step2').show();
							$('.step1').hide();
						}
						else{
							$('.step1').hide();
							$('.avia_message_box').show();
						}
					},
					error: function(error){
					}
				});
				e.preventDefault();
			}
		}
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
	(function($)
	{
		"use strict";

		$(document).ready(function()
		{
			$('[data-toggle="datepicker"]').datepicker();
			$("select").select2({
				minimumResultsForSearch: -1
			});
			$(".co_conditioners_number").select2({
				minimumResultsForSearch: -1
			});
			//Rate
			// the emotions can be an array
			var emotionsArray = ['angry','disappointed','meh', 'happy', 'inLove'];
			// or a single one

			$("#element").emotionsRating({
				emotionSize: 30,
				bgEmotion: 'happy',
				emotions: emotionsArray,
				color: '#FF0066', //the color must be expressed with a css code
				//    initialRating: 4, //initialize the rating number
				disabled: false, //set if the rating can be changed or not, default is false
				onUpdate: function(value) {} //set value changed event handler
			});



			function run() {
				$('.co_info:last .co_conditioners_type').on('change', function(){

					$(this).parents('.co_info').find('.co_service_type').slideDown("slow");
				});

				$('.co_info:last .co_service_type').on('change', function(){
					$(".co_conditioners_number").select2({
						minimumResultsForSearch: -1
					});
					$(".co_info:last .co_numbers,  .more_co,.othersDetails").slideDown("slow");

				});

			}
			run();

			var i = 0;

			$('.more_co_btn').on('click',function(){

				i++;

				var co_infoHTML = $('.co_info:eq(0)').clone();

				$('.more_co').before(`
									<div class="co_info cloneThis set">
										<div class="form-row co_type">
											<h3 class='first-heading'> نوع المكيف </h3>
									@foreach($airTypes as $type)
						<div class="pretty p-default p-round">
                            <input type="radio" name="air_type_id${i}" value="{{ $type->id }}" class="co_conditioners_type" data-name="{{ $type->type }}" data-id="{{ $type->id }}" />
										<div class="state p-warning-o">
											<label>{{ $type->type }}</label>
										</div>
									</div>
									<br/>
									@endforeach
						</div>

                        <div class="form-row hide co_service_type">
                            <h4 class='heading-type-ser'>نوع الخدمة</h4>
                            <p class='para1'>الأسعار تقريبية وتختلف بحسب عدد المكيفات ونوعها</p>

@foreach($services as $service)
						<div class="pretty p-default p-round">
                            <input type="radio" name="service_id${i}" value="{{ $service->id }}" class="co_service" data-name="{{ $service->name }}" data-id="{{ $service->id }}" />
										<div class="state p-warning-o">
											<label>{{ $service->name }}</label>
										</div>
									</div>
									<br/>
									@endforeach
						</div>

								<div class="form-row hide co_numbers">
									<h4 class='heading-type-ser'>عدد المكيفات</h4>
									<p class="para1"> في حال كان العدد أقل من 3 مكيفات فإن الفاتورة لن تقل عن 330 ريال.</p>
									<select style="width:90%;" name="number" class="co_conditioners_number">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
								</div>
`);

				run();

			});
// summBtn
			$('.summBtn').on('click',function() {
				$("table.summTable tbody tr").remove();
				var totalNumbers = 0;
				$('.co_info').each(function() {
					var coServiceId = $(this).find("input[name*='service_id']:checked").data('id');
					var coNumbs=$(this).find("select.co_conditioners_number").children("option:selected").val();
					if(coServiceId == 1){
						totalNumbers = parseInt(coNumbs) + parseInt(totalNumbers);
					}
				});
				$('.co_info').each(function(){
					var coCost = "";
					var cTotal = "";
					var coType=$(this).find("input[name*='air_type_id']:checked").data('name');
					var coTypeId=$(this).find("input[name*='air_type_id']:checked").data('id');
					var coService=$(this).find("input[name*='service_id']:checked").data('name');
					var coServiceId=$(this).find("input[name*='service_id']:checked").data('id');
					var coNumbs=$(this).find("select.co_conditioners_number").children("option:selected").val();
					if(coServiceId != 1){
						coCost = 'حسب الفحص' ;
						cTotal= 'حسب الفحص' ;
						var newTr = "<tr><td>" + coType + " </td><td>" + coService + "</td><td>" + coNumbs + "</td><td>" + coCost + "</td><td>" + cTotal + "</td></tr>";
						$("table.summTable tbody").append(newTr);
					}
					else{
						$.ajax({
							url: "get-price-range/"+ totalNumbers + "/" + coServiceId + "/" + coTypeId ,
							type: "GET",
							success: function(res){
								coCost = res;
								cTotal= res ;
								var newTr = "<tr><td>" + coType + " </td><td>" + coService + "</td><td>" + coNumbs + "</td><td>" + coCost + "</td><td>" + cTotal + "</td></tr>";
								$("table.summTable tbody").append(newTr);
							},
							error: function(error){
								alert('حدث خطأ');
							}
						});
					}

				});
				$(".order_summery").slideDown("slow");

			});


		});
	}(jQuery));

</script>
@endsection