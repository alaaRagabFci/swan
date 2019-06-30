<li class="nav-item {{Request::is('/adminpanel') ? 'start active open':'' }}">
    <a href="{{ url('/adminpanel') }}" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">لوحة التحكم</span>
        <span class="selected"></span>
    </a>
</li>
@if(Auth::user()->type == "Admin")
<li class="nav-item {{Request::is('settings') ? 'start active open':'' }}">
    <a href="{{ url('settings') }}" class="nav-link nav-toggle">
        <i class="fa fa-cogs"></i>
        <span class="title">الأعدادات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('contacts') ? 'start active open':'' }}">
    <a href="{{ url('contacts') }}" class="nav-link nav-toggle">
        <i class="fa fa-envelope"></i>
        <span class="title">الرسايل</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('countries', 'regions') ? 'start active open':'' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-globe"></i>
        <span class="title">الدول والحياء</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::is('countries') ? 'start active open':'' }}">
            <a href="{{ url('/countries') }}" class="nav-link ">
                <i class="fa fa-angle-left"></i>
                <span class="title"> الدول </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('regions') ? 'start active open':'' }}">
            <a href="{{ url('regions') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الأحياء</span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{Request::is('add-order-admin') ? 'start active open':'' }}">
    <a href="{{ url('add-order-admin') }}" class="nav-link nav-toggle">
        <i class="fa fa-plus"></i>
        <span class="title">أضافة طلب</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('orders', 'sms_not_confirmed', 'new-orders', 'not-assign-orders', 'accepted-orders', 'cancelled-orders', 'hanging-orders', 'under-appraisal-orders', 'completed-orders') ? 'start active open':'' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-shopping-cart"></i>
        <span class="title">الطلبات</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::is('sms_not_confirmed') ? 'start active open':'' }}">
            <a href="{{ url('/sms_not_confirmed') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الطلبات اللي لم تتحقق من الجوال</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('new-orders') ? 'start active open':'' }}">
            <a href="{{ url('/new-orders') }}" class="nav-link ">
                <i class="fa fa-angle-left"></i>
                <span class="title">    الطلبات الجديدة
                <span class="label label-success PendingOrders" data-id="{{ $applicationPending }}">{{ $applicationPending }}</span>
                </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('not-assign-orders') ? 'start active open':'' }}">
            <a href="{{ url('not-assign-orders') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الطلبات التي لم تسند</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('accepted-orders') ? 'start active open':'' }}">
            <a href="{{ url('accepted-orders') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">  الطلبات المسندة
                    <span class="label label-success AcceptedOrders" data-id="{{ $applicationPending }}"></span>
                </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('completed-orders') ? 'start active open':'' }}">
            <a href="{{ url('completed-orders') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الطلبات المنفذة
                    <span class="label label-success CompletedOrders" data-id="{{ $applicationPending }}"></span>
                </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('cancelled-orders') ? 'start active open':'' }}">
            <a href="{{ url('cancelled-orders') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الطلبات الملغية
                    <span class="label label-success CancelledOrders" data-id="{{ $applicationPending }}"></span>
                </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('hanging-orders') ? 'start active open':'' }}">
            <a href="{{ url('hanging-orders') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الطلبات المعلقة
                    <span class="label label-success HangingOrders" data-id="{{ $applicationPending }}"></span>

                </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('under-appraisal-orders') ? 'start active open':'' }}">
            <a href="{{ url('under-appraisal-orders') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الطلبات تحت التقييم
                    <span class="label label-success Under_AppraisalOrders" data-id="{{ $applicationPending }}"></span>

                </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('orders') ? 'start active open':'' }}">
            <a href="{{ url('/orders') }}" class="nav-link ">
                <i class="fa fa-angle-left"></i>
                <span class="title"> كل الطلبات </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{Request::is('categories') ? 'start active open':'' }}">
    <a href="{{ url('categories') }}" class="nav-link nav-toggle">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        <span class="title"> الفئات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('opened-not-rated', 'rated', 'rate-not-opened') ? 'start active open':'' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-star-o"></i>
        <span class="title">التقييمات</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::is('opened-not-rated') ? 'start active open':'' }}">
            <a href="{{ url('/opened-not-rated') }}" class="nav-link ">
                <i class="fa fa-angle-left"></i>
                <span class="title"> روابط فتحت ولم تقييم </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('rated') ? 'start active open':'' }}">
            <a href="{{ url('rated') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">طلبات قيمت</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('rate-not-opened') ? 'start active open':'' }}">
            <a href="{{ url('rate-not-opened') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">رابط التقييم لم يفتح</span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{Request::is('invoices') ? 'start active open':'' }}">
    <a href="{{ url('invoices') }}" class="nav-link nav-toggle">
        <i class="fa fa-file" aria-hidden="true"></i>
        <span class="title"> الفواتير</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('air-type-service-prices') ? 'start active open':'' }}">
    <a href="{{ url('air-type-service-prices') }}" class="nav-link nav-toggle">
        <i class="fa fa-money" aria-hidden="true"></i>
        <span class="title"> تسعيرة خدمات المكيفات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('companies') ? 'start active open':'' }}">
    <a href="{{ url('/companies') }}" class="nav-link nav-toggle">
        <i class="fa fa-building"></i>
        <span class="title">الشركات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('hours') ? 'start active open':'' }}">
    <a href="{{ url('/hours') }}" class="nav-link nav-toggle">
        <i class="fa fa-calendar" aria-hidden="true"></i>
        <span class="title">الوقت</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('air-types') ? 'start active open':'' }}">
    <a href="{{ url('air-types') }}" class="nav-link nav-toggle">
        <i class="fa fa-server"></i>
        <span class="title">أنواع التكييفات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('services') ? 'start active open':'' }}">
    <a href="{{ url('services') }}" class="nav-link nav-toggle">
        <i class="fa fa-server"></i>
        <span class="title">الخدمات</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item {{Request::is('logs') ? 'start active open':'' }}">
    <a href="{{ url('logs') }}" class="nav-link nav-toggle">
        <i class="fa fa-history" aria-hidden="true"></i>
        <span class="title">السجلات</span>
        <span class="selected"></span>
    </a>
</li>

@elseif(Auth::user()->type == "Company")
<li class="nav-item {{Request::is('company-new-orders', 'company-accepted-orders', 'company-completed-orders') ? 'start active open':'' }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-shopping-cart"></i>
        <span class="title">الطلبات</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::is('company-new-orders') ? 'start active open':'' }}">
            <a href="{{ url('/company-new-orders') }}" class="nav-link ">
                <i class="fa fa-angle-left"></i>
                <span class="title">    الطلبات الجديدة
                <span class="label label-success companyPending" data-id="{{ $applicationCompanyPending }}">{{ $applicationCompanyPending }}</span>
                </span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('company-accepted-orders') ? 'start active open':'' }}">
            <a href="{{ url('company-accepted-orders') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الطلبات المسندة</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Request::is('company-completed-orders') ? 'start active open':'' }}">
            <a href="{{ url('company-completed-orders') }}" class="nav-link nav-toggle">
                <i class="fa fa-angle-left"></i>
                <span class="title">الطلبات المكتمله</span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{Request::is('team-works') ? 'start active open':'' }}">
    <a href="{{ url('team-works') }}" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title">فريق العمل</span>
        <span class="selected"></span>
    </a>
</li>
@else
<li class="nav-item {{Request::is('team-accepted-orders', 'team-completed-orders') ? 'start active open':'' }}">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-shopping-cart"></i>
            <span class="title">الطلبات</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{Request::is('team-accepted-orders') ? 'start active open':'' }}">
                <a href="{{ url('team-accepted-orders') }}" class="nav-link nav-toggle">
                    <i class="fa fa-angle-left"></i>
                    <span class="title">الطلبات المسندة</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item {{Request::is('team-completed-orders') ? 'start active open':'' }}">
                <a href="{{ url('team-completed-orders') }}" class="nav-link nav-toggle">
                    <i class="fa fa-angle-left"></i>
                    <span class="title">الطلبات المكتمله</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>
@endif