@extends('front.layout')
@section('title','أتصل بنا')
@section('content')
        <div id='main' data-scroll-offset='0'>

            <div id='avia-google-map-nr-1' class='avia-google-maps avia-google-maps-section main_color  avia-builder-el-0  el_before_av_two_third  avia-builder-el-first  container_wrap fullsize'>
                <div id='av_gmap_1' class='avia-google-map-container' data-mapid='1' style='height: 200px;'></div>
            </div>
            <div id='after_full_slider_1' class='main_color av_default_container_wrap container_wrap fullsize'>
                <div class='container'>
                    <div class='template-page content  av-content-full alpha units'>
                        <div class='post-entry post-entry-type-page post-entry-245'>
                            <div class='entry-content-wrapper clearfix'>
                                <div class="flex_column av_two_third  av-animated-generic bottom-to-top  flex_column_div av-zero-column-padding first  avia-builder-el-1  el_after_av_google_map  el_before_av_one_third  avia-builder-el-first  " style='border-radius:0px; '>
                                    <div style='padding-bottom:0px;' class='av-special-heading av-special-heading-h3  blockquote modern-quote  avia-builder-el-2  el_before_av_hr  avia-builder-el-first  '>
                                        <h3 class='av-special-heading-tag' itemprop="headline">اتصل بنا</h3>
                                        <div class='special-heading-border'>
                                            <div class='special-heading-inner-border'></div>
                                        </div>
                                    </div>
                                    @if (\Session::has('message'))
                                        <div class="alert alert-success">
                                            <ul>
                                                <li style="text-align: center; list-style: none">{!! \Session::get('message') !!}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    <div style=' margin-top:10px; margin-bottom:10px;' class='hr hr-custom hr-right hr-icon-no  avia-builder-el-3  el_after_av_heading  el_before_av_contact '><span class='hr-inner   inner-border-av-border-fat' style=' width:50px; border-color:#efbb20;'><span class='hr-inner-style'></span></span>
                                    </div>
                                    <form  method="post" action="{{ url('send-message') }}" class="avia_ajax_form av-form-labels-visible   avia-builder-el-4  el_after_av_hr  avia-builder-el-last  " data-avia-form-id="1" data-avia-redirect=''>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <fieldset>
                                            <p class=' first_form  form_element form_element_third' id='element_avia_1_1'>
                                                <label for="avia_1_1">الاسم <abbr class="required" title="required">*</abbr></label>
                                                <input required name="name" class="text_input is_empty" type="text" id="avia_1_1" value="" />
                                            </p>
                                            <p class=' form_element form_element_third' id='element_avia_2_1'>
                                                <label for="avia_2_1">الجوال <abbr class="required" title="required">*</abbr></label>
                                                <input required name="phone" class="text_input is_phone" type="text" id="avia_2_1" value="" />
                                            </p>
                                            <p class=' form_element form_element_third' id='element_avia_3_1'>
                                                <label for="avia_3_1">البريد الإلكتروني <abbr class="required" title="required">*</abbr></label>
                                                <input required name="email" class="text_input is_email" type="text" id="avia_3_1" value="" />
                                            </p>
                                            <p class=' first_form  form_element form_fullwidth' id='element_avia_4_1'>
                                                <label for="avia_4_1">عنوان الرسالة <abbr class="required" title="required">*</abbr></label>
                                                <input required name="title" class="text_input is_empty" type="text" id="avia_4_1" value="" />
                                            </p>
                                            <p class=' first_form  form_element form_fullwidth' id='element_avia_5_1'>
                                                <label for="avia_5_1" class="textare_label hidden textare_label_avia_5_1">الرسالة <abbr class="required" title="required">*</abbr></label>
                                                <textarea required name="message" class="text_area is_empty" cols="40" rows="7" id="avia_5_1"></textarea>
                                            </p>
                                            {{--<p class='' id='element_avia_7_1'> <span class='value_verifier_label'>3 + 1 = ?</span>--}}
                                                {{--<input name="avia_7_1_verifier" type="hidden" id="avia_7_1_verifier" value="516282747" />--}}
                                                {{--<label for="avia_7_1">فضلا .. حل المعادلة الآتية (تلك وسيلة للتأكد من أنك لست روبوت :)) <abbr class="required" title="required">*</abbr></label>--}}
                                                {{--<input name="avia_7_1" class="text_input captcha" type="text" id="avia_7_1" value="" />--}}
                                            {{--</p>--}}
                                            <p class="form_element ">
                                                <button type="submit" value="إرسال" class="button" data-sending-label="Sending" />
                                                إرسال
                                                </button>
                                            </p>
                                        </fieldset>
                                    </form>
                                    <div id="ajaxresponse_1" class="ajaxresponse ajaxresponse_1 hidden"></div>
                                </div>
                                <div class="flex_column av_one_third  av-animated-generic bottom-to-top  flex_column_div av-zero-column-padding   avia-builder-el-5  el_after_av_two_third  avia-builder-el-last  " style='border-radius:0px; '>
                                    <div style='padding-bottom:0px;' class='av-special-heading av-special-heading-h3  blockquote modern-quote  avia-builder-el-6  el_before_av_hr  avia-builder-el-first  '>
                                        <h3 class='av-special-heading-tag' itemprop="headline">نسعد بتواصلكم معنا!</h3>
                                        <div class='special-heading-border'>
                                            <div class='special-heading-inner-border'></div>
                                        </div>
                                    </div>
                                    <div style=' margin-top:10px; margin-bottom:10px;' class='hr hr-custom hr-right hr-icon-no  avia-builder-el-7  el_after_av_heading  el_before_av_textblock '><span class='hr-inner   inner-border-av-border-fat' style=' width:50px; border-color:#efbb20;'><span class='hr-inner-style'></span></span>
                                    </div>
                                    <section class="av_textblock_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
                                        <div class='avia_textblock ' itemprop="text">
                                            <p>نسعد باستقبال الشكاوى والاقتراحات وطلبات انضمام الشركات ذات الخدمة عالية الجودة عبر هذه الصفحة أو عبر الجوال أو الواتساب أو الإيميل الموضحين أدناه.</p>
                                        </div>
                                    </section>
                                    
                                    <section class="av_textblock_section" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
                                        <div class='avia_textblock ' itemprop="text">
                                            <p><strong>منطقة التغطية</strong>
                                                <br /> نقوم بتغطية جميع أحياء مدينة الرياض</p>
                                            <p><strong>تواصل معنا</strong>
                                                <br />
                                                <a href="mailto:contact@getsawn.com">{{ $setting->email }}</a>
                                                <br />
                                                <a href="tel:0536600020">{{ $setting->phone }}</a></p>
                                            <p><strong>ساعات العمل:</strong>
                                                <br /> نسعد بخدمتكم جميع أيام الأسبوع من الساعة 11 صباحاً وحتى الساعة 11 مساءً ما عدا يوم الجمعة.</p>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- close content main div -->
                    <!-- section close by builder template -->
                </div>
                <!--end builder template-->
            </div>
            <!-- close default .container_wrap element -->
@endsection