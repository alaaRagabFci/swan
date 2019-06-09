<!DOCTYPE html>
<html dir="rtl" lang="ar" class=" html_stretched responsive av-preloader-disabled av-default-lightbox  html_header_top html_logo_right html_bottom_nav_header html_menu_center html_large html_header_sticky_disabled html_header_shrinking_disabled html_header_topbar_active html_mobile_menu_phone html_disabled html_header_searchicon_disabled html_content_align_center html_header_unstick_top_disabled html_header_stretch_disabled html_elegant-blog html_entry_id_244 ">
<head>
    <meta charset="UTF-8" />
    <title>صَون |  @yield('title') </title>
    <meta name="robots" content="index, follow" />
    <link rel="icon" href="img/SawnLogo_fav.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel='stylesheet' id='bootstrap-grid-css' href='{{ asset("/admin_ui/front/css/bootstrap.css")}}'/>
	<link rel='stylesheet' id='bootstrap-rtl-css' href='{{ asset("/admin_ui/front/css/bootstrap-rtl.css")}}'/>
    <link rel='stylesheet' id='avia-grid-css' href='{{ asset("/admin_ui/front/css/grid77ae.css")}}'/>
    <link rel='stylesheet' id='avia-base-css' href='{{ asset("/admin_ui/front/css/base77ae.css")}}'/>
    <link rel='stylesheet' id='avia-layout-css' href='{{ asset("/admin_ui/front/css/layout77ae.css")}}'/>
    <link rel='stylesheet' id='avia-scs-css' href='{{ asset("/admin_ui/front/css/shortcodes77ae.css")}}'/>
    <link rel='stylesheet' id='avia-rtl-css' href='{{ asset("/admin_ui/front/css/rtl68b3.css")}}'/>

    <link rel='stylesheet' href='{{ asset("/admin_ui/front/css/datepicker.min.css")}}' type='text/css'  />
    <link rel='stylesheet' href='{{ asset("/admin_ui/front/css/select2.min.css")}}' type='text/css'  />
    <link rel='stylesheet' href='{{ asset("/admin_ui/front/css/pretty-checkbox.min.css")}}' type='text/css'  />
    <link rel='stylesheet' id='avia-dynamic-css' href='{{ asset("/admin_ui/front/css/sawnac29.css")}}' type='text/css' media='all' />
    <link rel='stylesheet' href='{{ asset("/admin_ui/front/css/main.css")}}' type='text/css' media='all' />
    <script src="{{ asset('/admin_ui/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>

    <script type='text/javascript' src='{{ asset("/admin_ui/front/js/jqueryb8ff.js")}}'></script>
    <script type='text/javascript' src='{{ asset("/admin_ui/front/js/mediaelement-and-player.min45a0.js?ver=4.2.6-78496d1")}}'></script>
<script type='text/javascript' src='{{ asset("/admin_ui/front/js/mediaelement-migrate.min5010.js?ver=4.9.8")}}'></script>
    <script type='text/javascript' src='{{ asset("/admin_ui/front/js/jquery.magnific-popup.min77ae.js")}}'></script>
    <script type='text/javascript' src='{{ asset("/admin_ui/front/js/datepicker.min.js")}}'></script>
    <!--[if lt IE 9]><script src="http://getsawn.com/wp-content/themes/enfold/js/html5shiv.js"></script><![endif]-->
</head>
<body id="top" class="rtl home page-template-default page page-id-244 stretched metrophobic helvetica-neue-websave _helvetica_neue " itemscope="itemscope" itemtype="https://schema.org/WebPage">
    <div id='wrap_all'>
        <header id='header' class=' header_color light_bg_color  av_header_top av_logo_right av_bottom_nav_header av_menu_center av_large av_header_sticky_disabled av_header_shrinking_disabled av_header_stretch_disabled av_mobile_menu_phone av_header_searchicon_disabled av_header_unstick_top_disabled av_seperator_small_border' role="banner" itemscope="itemscope" itemtype="https://schema.org/WPHeader">

            <a id="advanced_menu_toggle" href="#" aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></a>
            <a id="advanced_menu_hide" href="#" aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></a>
            <div id='header_meta' class='container_wrap container_wrap_meta  av_icon_active_left av_extra_header_active av_entry_id_244'>
                <div class='container'>
                    <ul class='noLightbox social_bookmarks icon_count_2'>
                        <li class='social_bookmarks_twitter av-social-link-twitter social_icon_1'><a target='_blank' href='{{ $setting->twitter }}' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello' title='Twitter'><span class='avia_hidden_link_text'>Twitter</span></a></li>
                        <li class='social_bookmarks_instagram av-social-link-instagram social_icon_2'><a target='_blank' href='{{ $setting->instgram }}' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello' title='Instagram'><span class='avia_hidden_link_text'>Instagram</span></a></li>
                    </ul>
                </div>
            </div>
            <div id='header_main' class='container_wrap container_wrap_logo'>
                <div class='container av-logo-container'>
                    <div class='inner-container'><strong class='logo'><a href='{{ url('/') }}'>
                                <img height='100' width='300' src='{{ asset("admin_ui/front/img/SawnLogo_Website_%402x-1-300x138.png")}}' alt='صَون' /></a></strong></div>
                </div>
                <div id='header_main_alternate' class='container_wrap'>
                    <div class='container'>
                        <nav class='main_menu' data-selectname='Select a page' role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
                            <div class="avia-menu av-main-nav-wrap">
                                <ul id="avia-menu" class="menu av-main-nav">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home  {{Request::is('/') ? 'current-menu-item page_item page-item-244 current_page_item menu-item-top-level':'' }}  "><a href="{{ url('/') }}" itemprop="url"><span class="avia-bullet"></span><span class="avia-menu-text">الرئيسية</span><span class="avia-menu-fx"><span class="avia-arrow-wrap"><span class="avia-arrow"></span></span></span></a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level {{Request::is('contact-us') ? 'current-menu-item page_item page-item-244 current_page_item menu-item-top-level':'' }} "><a href="{{ url('/contact-us') }}" itemprop="url"><span class="avia-bullet"></span><span class="avia-menu-text">اتصل بنا</span><span class="avia-menu-fx"><span class="avia-arrow-wrap"><span class="avia-arrow"></span></span></span></a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level {{Request::is('check-order-status', 'check-phone') ? 'current-menu-item page_item page-item-244 current_page_item menu-item-top-level':'' }}"><a href="{{ url('/check-order-status') }}" itemprop="url"><span class="avia-bullet"></span><span class="avia-menu-text">متابعة حالة الطلب</span><span class="avia-menu-fx"><span class="avia-arrow-wrap"><span class="avia-arrow"></span></span></span></a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page av-menu-button av-menu-button-colored menu-item-top-level {{Request::is('order-now') ? 'current-menu-item page_item page-item-244 current_page_item menu-item-top-level':'' }}"><a href="{{ url('/order-now') }}" itemprop="url"><span class="avia-bullet"></span><span class="avia-menu-text">اطلب الآن!</span><span class="avia-menu-fx"><span class="avia-arrow-wrap"><span class="avia-arrow"></span></span></span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- end container_wrap-->
            </div>
            <div class='header_bg'></div>
            <!-- end header -->
        </header>


 @yield('content')

        <div class='container_wrap footer_color' id='footer'>
            <div class='container'>
                <div class='flex_column av_one_third  first el_before_av_one_third'>
                    <section id="text-6" class="widget clearfix widget_text">
                        <h3 class="widgettitle">ساعات العمل</h3>
                        <div class="textwidget">
                            <p>نسعد بخدمتكم في رمضان جميع أيام الأسبوع من الساعة 7 مساءً وحتى الساعة 2 صباحاً ما عدا يوم الجمعة.</p>
                        </div>
                        <span class="seperator extralight-border"></span>
                    </section>
                </div>
                <div class='flex_column av_one_third  el_after_av_one_third  el_before_av_one_third '>
                    <section id="text-8" class="widget clearfix widget_text">
                        <h3 class="widgettitle">اتصل بنا</h3>
                        <div class="textwidget">
                            جوال أو واتساب: <a href="tel:0536600020">{{ $setting->phone }}</a>
                            <br /> البريد الإلكتروني:
                            <a href="mailto:contact@getsawn.com">{{ $setting->email }}</a>
                        </div>
                        <span class="seperator extralight-border"></span>
                    </section>
                </div>
                <div class='flex_column av_one_third  el_after_av_one_third  el_before_av_one_third '>
                    <section id="text-5" class="widget clearfix widget_text">
                        <h3 class="widgettitle">صون لخدمات التكييف</h3>
                        <div class="textwidget">
                            <p> {{ $setting->informations }} </p>
                        </div>
                        <span class="seperator extralight-border"></span>
                    </section>
                </div>
            </div>
        </div>
        <footer class='container_wrap socket_color' id='socket' role="contentinfo" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
            <div class='container'>
                <span class='copyright'>جميع الحقوق محفوظة لمؤسسة صون المنزل لتقنية المعلومات</span>
                <ul class='noLightbox social_bookmarks icon_count_2'>
                    <li class='social_bookmarks_twitter av-social-link-twitter social_icon_1'><a target='_blank' href='{{ $setting->twitter }}' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello' title='Twitter'><span class='avia_hidden_link_text'>Twitter</span></a></li>
                    <li class='social_bookmarks_instagram av-social-link-instagram social_icon_2'><a target='_blank' href='{{ $setting->instgram }}' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello' title='Instagram'><span class='avia_hidden_link_text'>Instagram</span></a></li>
                </ul>
            </div>
        </footer>
        <div id='spinner' class='spinner'></div>

        <script type='text/javascript' src='{{ asset("/admin_ui/front/js/bootstrap.min.js")}}'></script>
        <script type='text/javascript' src='{{ asset("/admin_ui/front/js/avia592e.js")}}'></script>
        <script type='text/javascript' src='{{ asset("/admin_ui/front/js/shortcodes592e.js")}}'></script>
        <script type='text/javascript' src='{{ asset("/admin_ui/front/js/emotion-ratings.min.js")}}'></script>
        <script type='text/javascript' src='{{ asset("/admin_ui/front/js/select2.min.js")}}'></script>
{{--        <script type='text/javascript' src='{{ asset("/admin_ui/front/js/customcode.js")}}'></script>--}}
        @yield('scripts')
        <a href='#top' title='Scroll to top' id='scroll-top-link' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'><span class="avia_hidden_link_text">Scroll to top</span></a>
        <div id="fb-root"></div>
        <script>
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

            function cancelOrder(status, id) {
                    var reason = window.prompt("سبب الألغاء ", "");
                    if(reason){
                        $.ajax({
                            url: "cancel-order/" + id + "/" + status + "/" + reason,
                            type: "GET",
                            beforeSend: function(){
                                $('.cancel-order').show();
                                $('.xx').hide();
                            },
                            success: function(res){
                                location.reload();
                            },
                            error: function(){
                                $('.cancel-order').hide();
                                $('.xx').show();
                            }
                        });
                    }
            }
        </script>
</body>
</html>

