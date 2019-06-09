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
										<input type="radio" name="air_type_id{{ $type->id }}" value="{{ $type->id }}" class="co_conditioners_type" data-name="{{ $type->type }}" />
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
										<input type="radio" name="service_id{{ $service->id }}" value="{{ $service->id }}" class="co_service" data-name="{{ $service->name }}" />
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
											<select style="width:90%;" name="co_conditioners_number" class="co_conditioners_number">
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


		// summTable
		
		
// summBtn
		$('.summBtn').on('click',function() {
			$("table.summTable tbody tr").remove();
			$('.co_info').each(function(){
				 var coType=$(this).find("input[name*='co_conditioners_type']:checked").data('name');
				 var coService=$(this).find("input[name*='co_service']:checked").data('name');
				 var coNumbs=$(this).find("select.co_conditioners_number").children("option:selected").val();
				// var data = $('.co_conditioners_number').select2('data')
				//  var coNumbs=data[0].text;
				//  var coNumbs=$(this).find('.co_conditioners_number option:selected').text();
 				 var coCost = 100 ;
				 var cTotal= 100 ;
				 var newTr = "<tr><td>" + coType + " </td><td>" + coService + "</td><td>" + coNumbs + "</td><td>" + coCost + "</td><td>" + cTotal + "</td></tr>";
				 $("table.summTable tbody").append(newTr);

 });
$(".order_summery").slideDown("slow");

});


	});
	 













}(jQuery));
