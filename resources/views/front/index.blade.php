@extends('front.layout')
@section('title','الصفحة الرئيسية')
@section('content')
        <div id='main' data-scroll-offset='0'>

            <div id='av_section_1' class='avia-section main_color avia-section-default avia-no-border-styling avia-full-stretch av-parallax-section avia-bg-style-parallax  avia-builder-el-0  el_before_av_section  avia-builder-el-first  container_wrap fullsize' style='background-color: #efbb20; ' data-section-bg-repeat='stretch'>
                <div class='av-parallax' data-avia-parallax-ratio='0.3'>
                    <div class='av-parallax-inner main_color  avia-full-stretch'
						 style='background-color: #efbb20; background-repeat: no-repeat;
						 background-image: url({{ asset('admin_ui/front/img/house-wire-model-fade-white-1500x1085.png') }}); background-attachment: scroll; background-position: center right; '></div>
                </div>
                <div class='container'>
                    <main role="main" itemprop="mainContentOfPage" class='template-page content  av-content-full alpha units'>
                        <div class='post-entry post-entry-type-page post-entry-244'>
                            <div class='entry-content-wrapper clearfix'>
                                <div class='flex_column_table av-equal-height-column-flextable'>
                                    <div class="flex_column av_three_fourth  av-animated-generic left-to-right  flex_column_table_cell av-equal-height-column av-align-middle av-zero-column-padding first  avia-builder-el-1  el_before_av_one_fourth  avia-builder-el-first  " style='border-radius:0px; '>
                                        <div style='padding-bottom:0px;color:#ffffff;font-size:30px;' class='av-special-heading av-special-heading-h1 custom-color-heading blockquote modern-quote  avia-builder-el-2  avia-builder-el-no-sibling  av-inherit-size'>
                                            <h1 class='av-special-heading-tag' itemprop="headline">صون لخدمات التكييف</h1>
                                            <div class='av-subheading av-subheading_below av_custom_color' style='font-size:15px;'>
                                                <p>{{ $setting->informations }}</p>
                                            </div>
                                            <div class='special-heading-border'>
                                                <div class='special-heading-inner-border' style='border-color:#ffffff'></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='av-flex-placeholder'></div>
                                    <div class="flex_column av_one_fourth  av-animated-generic right-to-left  flex_column_table_cell av-equal-height-column av-align-middle av-zero-column-padding   avia-builder-el-3  el_after_av_three_fourth  avia-builder-el-last  " style='border-radius:0px; '>
                                        <div class='avia-button-wrap avia-button-center  avia-builder-el-4  el_before_av_button  avia-builder-el-first '><a href='{{ url('order-now') }}' class='avia-button  avia-icon_select-no avia-color-custom avia-size-large avia-position-center ' style='background-color:#ffffff; border-color:#ffffff; color:#efbb20; '><span class='avia_iconbox_title' >اطلب الآن!</span></a></div>
                                        <div class='avia-button-wrap avia-button-center  avia-builder-el-5  el_after_av_button  avia-builder-el-last '><a href='{{ url('check-order-status') }}' class='avia-button  avia-icon_select-no avia-color-light avia-size-small avia-position-center '><span class='avia_iconbox_title' >متابعة حالة الطلب</span></a></div>
                                    </div>
                                </div>
                                <!--close column table wrapper. Autoclose:  -->
                            </div>
                        </div>
                    </main>
                    <!-- close content main element -->
                </div>
            </div>
            <div id='av_section_2' class='avia-section alternate_color avia-section-large avia-no-border-styling av-parallax-section avia-bg-style-parallax  avia-builder-el-6  el_after_av_section  avia-builder-el-last  container_wrap fullsize' data-section-bg-repeat='no-repeat'>
                <div class='av-parallax' data-avia-parallax-ratio='0.3'>
                    <div class='av-parallax-inner alternate_color  avia-full-stretch' style='background-repeat: no-repeat; background-image: url({{ asset('admin_ui/front/img/house-wire-model-fade-white-1500x1085.png') }}); background-attachment: scroll; background-position: top left; '></div>
                </div>
                <div class='container'>
                    <div class='template-page content  av-content-full alpha units'>
                        <div class='post-entry post-entry-type-page post-entry-244'>
                            <div class='entry-content-wrapper clearfix'>
                                <div style='padding-bottom:0px;' class='av-special-heading av-special-heading-h2  blockquote modern-quote modern-centered  avia-builder-el-7  el_before_av_hr  avia-builder-el-first  '>
                                    <h2 class='av-special-heading-tag' itemprop="headline">خدماتنا</h2>
                                    <div class='special-heading-border'>
                                        <div class='special-heading-inner-border'></div>
                                    </div>
                                </div>
                                <div style=' margin-top:5px; margin-bottom:35px;' class='hr hr-custom hr-center hr-icon-no  avia-builder-el-8  el_after_av_heading  el_before_av_one_third '><span class='hr-inner   inner-border-av-border-fat' style=' width:50px; border-color:#efbb20;'><span class='hr-inner-style'></span></span></div>
								<div class='row content-services'>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<article class="iconbox iconbox_left_content   avia-builder-el-10  avia-builder-el-no-sibling " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
											<div class="iconbox_icon heading-color" aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></div>
											<div class="iconbox_content">
												<header class="entry-content-header">
													<h3 class='iconbox_content_title' itemprop="headline" style='color:#efbb20; '>تنظيف داخلي وخارجي</h3>
												</header>
												<div class='iconbox_content_container av_inherit_color' itemprop="text" style='color:#ffffff; '>
													<p>نقوم بتنظيف المكيف بضغط الماء العالي وهو في مكانه ، الطريقه الحديثه التي تقوم بإزالة كافة الأوساخ والحشرات المتراكمه داخل المكيف ، ولأننا نهتم بنظافة منزلكم فنقوم بوضع عوازل قبل أن نبدأ بالعمل.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
									</div>
									 <div class="col-md-4 col-sm-6 col-xs-12">
										<article class="iconbox iconbox_left_content   avia-builder-el-12  avia-builder-el-no-sibling " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
											<div class="iconbox_icon heading-color" aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></div>
											<div class="iconbox_content">
												<header class="entry-content-header">
													<h3 class='iconbox_content_title' itemprop="headline" style='color:#efbb20; '>تعبئة فريون</h3></header>
												<div class='iconbox_content_container av_inherit_color' itemprop="text" style='color:#ffffff; '>
													<p>نقوم بفحص التمديدات في حالة كان هنالك تسريب للفريون وبعد ذلك نقوم بمعالجة التسريب إن وجد ، ومن ثم نقوم بتعبئة الفريون بالقدر المناسب.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<article class="iconbox iconbox_left_content   avia-builder-el-14  avia-builder-el-no-sibling " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
											<div class="iconbox_icon heading-color" aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></div>
											<div class="iconbox_content">
												<header class="entry-content-header">
													<h3 class='iconbox_content_title' itemprop="headline" style='color:#efbb20; '>فك أو تركيب</h3></header>
												<div class='iconbox_content_container av_inherit_color' itemprop="text" style='color:#ffffff; '>
													<p>في حال كان لديك مكيف وترغب بتركيبه ، لاتشيل هم نركبه لك ، وفي حال كنت ترغب في فك مكيف من مكان وتركيبه في مكان آخر أو في منزل آخر ، أيضاً لاتشيل هم بنقوم بالواجب.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<article class="iconbox iconbox_left_content   avia-builder-el-16  avia-builder-el-no-sibling " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
											<div class="iconbox_icon heading-color" aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></div>
											<div class="iconbox_content">
												<header class="entry-content-header">
													<h3 class='iconbox_content_title' itemprop="headline" style='color:#efbb20; '>تسريب مياه</h3></header>
												<div class='iconbox_content_container av_inherit_color' itemprop="text" style='color:#ffffff; '>
													<p>مكيفك يسرب ماء ؟ ، ولا يهمّك نقوم بفحص المشكلة ومعالجتها فوراً.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<article class="iconbox iconbox_left_content   avia-builder-el-18  avia-builder-el-no-sibling " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
											<div class="iconbox_icon heading-color" aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></div>
											<div class="iconbox_content">
												<header class="entry-content-header">
													<h3 class='iconbox_content_title' itemprop="headline" style='color:#efbb20; '>عدم التبريد</h3></header>
												<div class='iconbox_content_container av_inherit_color' itemprop="text" style='color:#ffffff; '>
													<p>مزعّلك المكيف لأنه مايبرد ؟ ، ولا يهمّك نفحص المشكلة ونفرّحك ببرودته.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<article class="iconbox iconbox_left_content   avia-builder-el-20  avia-builder-el-no-sibling " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
											<div class="iconbox_icon heading-color" aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></div>
											<div class="iconbox_content">
												<header class="entry-content-header">
													<h3 class='iconbox_content_title' itemprop="headline" style='color:#efbb20; '>خدمات أخرى</h3></header>
												<div class='iconbox_content_container av_inherit_color' itemprop="text" style='color:#ffffff; '>
													<p>مكيفك مبهذلك وماتدري وش علّته ؟ ، ولايهمّك خلّها علينا.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
@endsection