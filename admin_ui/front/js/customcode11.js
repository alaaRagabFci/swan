(function($)
{	
    "use strict";

    $(document).ready(function()
    {
        $('[data-toggle="datepicker"]').datepicker();
		$("select").select2({
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

				$(this).parents('.co_info').find('.co_service_type').show();
			});
			
			$('.co_info:last .co_service_type').on('change', function(){

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
											<div class="pretty p-default p-round">
												<input type="radio" name="co_conditioners_type[${i}]" class="co_conditioners_type" value="split" />
												<div class="state p-warning-o">
													<label>سبيليت</label>
												</div>
											</div>
											<br/>
											<div class="pretty p-default p-round">
												<input type="radio" name="co_conditioners_type[${i}]" class="co_conditioners_type" value="concealed" />
												<div class="state p-warning-o">
													<label>سبيليت مخفي</label>
												</div>
											</div>
											<br/>
											<div class="pretty p-default p-round">
												<input type="radio" name="co_conditioners_type[${i}]" class="co_conditioners_type" value="central" />
												<div class="state p-warning-o">
													<label>مركزي</label>
												</div>
											</div>
											<br/>
											<div class="pretty p-default p-round">
												<input type="radio" name="co_conditioners_type[${i}]" class="co_conditioners_type" value="window" />
												<div class="state p-warning-o">
													<label>شباك</label>
												</div>
											</div>
											<br/>
											<div class="pretty p-default p-round">
												<input type="radio" name="co_conditioners_type[${i}]" class="co_conditioners_type" value="freestanding" />
												<div class="state p-warning-o">
													<label>دولاب (فريستاند)</label>
												</div>
											</div>
											<br/>
											
										</div>

										<div class="form-row hide co_service_type">
											<h4 class='heading-type-ser'>نوع الخدمة</h4>
											<p class='para1'>الأسعار تقريبية وتختلف بحسب عدد المكيفات ونوعها</p>
											

											<div class="pretty p-default p-round">
												<input type="radio" name="co_service[${i}]" class="co_service" value="cleaning_interior_exterior" />
												<div class="state p-warning-o">
													<label>تنظيف داخلي وخارجي <span style='color: #BBBBBB;font-size: 11px;'>(تقنية ضغط الماء العالي) (يبدأ من 100 ريال)</span></label>
												</div>
											</div>
											<br/>
										
											<div class="pretty p-default p-round">
												<input type="radio" name="co_service[${i}]" class="co_service" value="freon_filling" />
												<div class="state p-warning-o">
													<label>تعبئة فريون <span style='color: #BBBBBB;font-size: 11px;'>(يبدأ من 50 ريال)</span></label>
												</div>
											</div>
											<br/>
											<div class="pretty p-default p-round">
												<input type="radio" name="co_service[${i}]" class="co_service" value="installation_and_uninstallation" />
												<div class="state p-warning-o">
													<label>فك أو تركيب <span style='color: #BBBBBB;font-size: 11px;'>(يبدأ من 80 ريال)</span style='color: #BBBBBB;font-size: 11px;'></label>
												</div>
											</div>
											<br/>
											<div class="pretty p-default p-round">
												<input type="radio" name="co_service[${i}]" class="co_service" value="water_leak" />
												<div class="state p-warning-o">
													<label>تسريب مياه <span style='color: #BBBBBB;font-size: 11px;'>(حسب الفحص)</span></label>
												</div>
											</div>
											<br/>
											<div class="pretty p-default p-round">
												<input type="radio" name="co_service[${i}]" class="co_service" value="lack_of_cooling" />
												<div class="state p-warning-o">
													<label>عدم التبريد <span style='color: #BBBBBB;font-size: 11px;'>(حسب الفحص)</span></label>
												</div>
											</div>
											<br/>
											<div class="pretty p-default p-round">
												<input type="radio" name="co_service[${i}]" class="co_service" value="other" />
												<div class="state p-warning-o">
													<label>أخرى <span style='color: #BBBBBB;font-size: 11px;'>(حسب الاتفاق)</span></label>
												</div>
											</div>
											<br/>
										</div>

										<div class="form-row hide co_numbers">
											<h4 class='heading-type-ser'>عدد المكيفات</h4>
											<p class="para1"> في حال كان العدد أقل من 3 مكيفات فإن الفاتورة لن تقل عن 330 ريال.</p>
											<select style="width:90%;" name="co_conditioners_number" id="co_conditioners_number">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										</div>
									</div>      
                                    `);
														
														run();		

		});

		
		


	});
	 













}(jQuery));
