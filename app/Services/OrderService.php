<?php

namespace App\Services;
use App\Constants\ApplicationRate;
use App\Constants\NotificationType;
use App\Constants\OrderStatus;
use App\Constants\UserType;
use App\Jobs\SendNotificationCompanies;
use App\Models\ApplicationAirTypeService;
use App\Models\CompanyOrder;
use App\Models\ServicePriceDetails;
use App\Models\Setting;
use App\Models\UserDevice;
use App\Models\UserRate;
use App\Services\NotificationService;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Artisan;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Application;
use App\Helpers\PushNotification;
use Auth;

class OrderService
{
    public $notificationService, $categoryService;
    public function __construct(NotificationService $notificationService, CategoryService $categoryService){
        $this->notificationService = $notificationService;
        $this->categoryService = $categoryService;
    }

//    All orders
    public function listAllOrders()
    {
        return Application::with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function airTypesNumber($applicationId)
    {
        return ApplicationAirTypeService::where('application_id', $applicationId)->get(['number']);
    }
    public function datatables($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('status', function (Application $application){
                if($application->status == "Pending")
                    return '<span class="label label-sm label-primary"> طلب جديد </span>';
                if($application->status == "Accepted")
                    return '<span class="label label-sm label-success"> طلب مسند </span>';
                if($application->status == "Completed")
                    return '<span class="label label-sm label-default"> طلب منفذ </span>';
                if($application->status == "Hanging")
                    return '<span class="label label-sm label-danger"> طلب معلق </span>';
                if($application->status == "Cancelled")
                    return '<span class="label label-sm label-warning"> طلب ملغي </span>';
                if($application->status == "Sms_Not_Confirmed")
                    return '<span class="label label-sm label-warning"> طلب لم يتحقق من الجوال </span>';
                if($application->status == "Not-Assign")
                    return '<span class="label label-sm label-warning"> طلب لم يسند </span>';
                else
                    return '<span class="label label-sm label-info"> طلب تحت التقييم </span>';
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['actions', 'region', 'getServiceTypes', 'getAirTypes', 'status', 'company', 'air_number'])->make(true);

        return $tableData ;
    }

    public function getOrderDetails($id){
        return UserRate::where('application_id', $id)->get();
    }

    public function getInvoiceDetails($id){
        return Application::where('id', $id)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesInvoiceDetails($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->rawColumns(['getServiceTypes', 'getAirTypes', 'air_number'])->make(true);

        return $tableData ;
    }

    public function datatablesRate($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('company', function (UserRate $rate){
                return $rate->getCompany->name;
            })
            ->addColumn('application', function (UserRate $rate){
                return $rate->getApplication->name;
            })
            ->rawColumns(['company', 'application'])->make(true);

        return $tableData ;
    }

    public function getOrder($orderId)
    {
        try {
            $order = Application::with('getRegion', 'getServiceTypes', 'getAirTypes')->findOrFail($orderId);
            return $order;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Order not found');
        }
    }

    public function cancelOrder($orderId, $status, $reason)
    {
        $order = $this->getOrder($orderId);
        $order->status = $status;
        $order->cancellation_reason = $reason;
        $order->save();
        if($order->company_id){
            //send push notification to team works & companies
            $admin = User::where('type' , UserType::ADMIN)->first();
            $teamWorksIds = User::where(['company_id' => $order->company_id, 'type' => UserType::TEAM_WORK])->get(['id']);
            $teamWorksTokens = UserDevice::whereIn('user_id', $teamWorksIds)->get();
            $companyTokens = UserDevice::where('user_id', $order->company_id)->get();
            $tokens = [];
            foreach($teamWorksTokens as $teamWorksToken){
                $tokens[] = $teamWorksToken->device_token;
            }

            foreach($companyTokens as $companyToken){
                $tokens[] = $companyToken->device_token;
            }
            PushNotification::push_notification(
                [
                    "target" => $tokens,
                    "title" => 'تم الغاء الطلب',
                    "type" => 'OrderCancelled'
                ]
            );

            foreach($teamWorksIds as $teamWorksId){
                $this->notificationService->create(
                    $teamWorksId->id,
                    $order->id,
                    NotificationType::APPLICATION,
                    ' تم الغاء الطلب رقم '. $order->id,
                    '',
                    UserType::TEAM_WORK
                );
            }

            $this->notificationService->create(
                $order->company_id,
                $order->id,
                NotificationType::APPLICATION,
                ' تم الغاء الطلب رقم '. $order->id,
                '',
                UserType::COMPANY
            );

            $this->notificationService->create(
                $admin->id,
                $order->id,
                NotificationType::APPLICATION,
                ' تم الغاء الطلب رقم '. $order->id,
                '',
                UserType::ADMIN
            );
        }
        else{
            CompanyOrder::where('application_id', $orderId)->delete();
        }
        return $order;
    }

    public function changeOrderStatus($orderId, $status, $reason)
    {
        $order = $this->getOrder($orderId);
        $order->status = $status;

        if($status == "Pending"){
            $order->company_id = null;
            $order->is_active = true;
            //call function to loop for categories
        }
        if($status == "Cancelled"){
            if($order->company_id){
                //send push notification to team works & companies
                $teamWorksIds = User::where(['company_id' => $order->company_id, 'type' => UserType::TEAM_WORK])->get(['id']);
                $teamWorksTokens = UserDevice::whereIn('user_id', $teamWorksIds)->get();
                $companyTokens = UserDevice::where('user_id', $order->company_id)->get();
                $tokens = [];
                foreach($teamWorksTokens as $teamWorksToken){
                    $tokens[] = $teamWorksToken->device_token;
                }

                foreach($companyTokens as $companyToken){
                    $tokens[] = $companyToken->device_token;
                }
                PushNotification::push_notification(
                    [
                        "target" => $tokens,
                        "title" => 'تم الغاء الطلب',
                        "type" => 'OrderCancelled'
                    ]
                );

                foreach($teamWorksIds as $teamWorksId){
                    $this->notificationService->create(
                        $teamWorksId->id,
                        $order->id,
                        NotificationType::APPLICATION,
                        ' تم الغاء الطلب رقم '. $order->id,
                        '',
                        UserType::TEAM_WORK
                    );
                }

                $this->notificationService->create(
                    $order->company_id,
                    $order->id,
                    NotificationType::APPLICATION,
                    ' تم الغاء الطلب رقم '. $order->id,
                    '',
                    UserType::COMPANY
                );
            }
            else{
                CompanyOrder::where('application_id', $orderId)->delete();
            }
        }
        if($status == "Hanging"){
            if($reason)
                $order->reason = $reason;

            $companyTokens = UserDevice::where('user_id', $order->company_id)->get();
            $tokens = [];

            foreach($companyTokens as $companyToken){
                $tokens[] = $companyToken->device_token;
            }
            PushNotification::push_notification(
                [
                    "target" => $tokens,
                    "title" => 'تم تعليق الطلب',
                    "type" => 'OrderHanged'
                ]
            );


            $this->notificationService->create(
                $order->company_id,
                $order->id,
                NotificationType::APPLICATION,
                ' تم تعليق الطلب رقم '. $order->id,
                '',
                UserType::COMPANY
            );
        }

        $order->save();
        return $order;
    }

    public function verifyNumber($parameters)
    {
        $application = Application::where(['id' => $parameters['order_id'], 'confirmation_code' => $parameters['confirmation_code']])->first();
        if($application){
            $application->is_active = true;
            $application->status = OrderStatus::PENDING;
            $application->save();
            dispatch(new SendNotificationCompanies($application));

//            Artisan::queue('AssignCompaniesToApplication:assignCompaniesToApplication',['application' => $application]);

//            $this->assignCompanies($application);

            return $application;
        }else{
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

//    public function assignCompanies($application){
//        $categories = $this->categoryService->listCategories();
//        foreach ($categories as $category){
//            $companies = User::where('category_id', $category->id)->get();
//            foreach ($companies as $company){
//                if($application->status != OrderStatus::ACCEPTED){
//                    $companyOrder = new CompanyOrder();
//                    $companyOrder->company_id = $company->id;
//                    $companyOrder->application_id = $application->id;
//                    $companyOrder->save();
//
//                    //send push notification to assigned company
//                    $companyTokens = UserDevice::where('user_id', $company->id)->get();
//                    $tokens = [];
//                    foreach($companyTokens as $companyToken){
//                        $tokens[] = $companyToken->device_token;
//                    }
//
//                    PushNotification::push_notification(
//                        [
//                            "target" => $tokens,
//                            "title" => 'طلب مسند',
//                            "type" => 'NewAssignedOrder'
//                        ]
//                    );
//
//                    $this->notificationService->create(
//                        $company->id,
//                        $application->id,
//                        NotificationType::APPLICATION,
//                        'تم أسناد طلب جديد رقم ' . $application->id,
//                        'company-new-orders',
//                        UserType::COMPANY
//                    );
//                    //sleep time if status still pending loop again
//                    $setting = Setting::first();
//                }
//                Artisan::queue('AssignCompaniesToApplication:assignCompaniesToApplication',['application']);
//                sleep($setting->waiting_order_time * 60); //continue
//            }
//        }
//        return 'true';
//    }

    public function getRange($totalNumbers, $serviceId, $airTypeId){
        $price = ServicePriceDetails::where(['service_id' => $serviceId, 'air_type_id' => $airTypeId])
                                    ->where('range_from', '<=', $totalNumbers)
                                    ->where('range_to', '>=', $totalNumbers)
                                    ->first();
        return $price;
    }

    public function agreeOrder($orderId)
    {
        $order = $this->getOrder($orderId);
        $order->status = 'Accepted';
        $order->company_id = Auth::user()->id;
        $order->save();
        if($order)
            CompanyOrder::where('application_id', $orderId)->delete();

        //send push notification to team works
        //create notification
        $teamWorksIds = User::where(['company_id' => Auth::user()->id, 'type' => UserType::TEAM_WORK])->get(['id']);
        foreach($teamWorksIds as $teamWorksId){
            $this->notificationService->create(
                $teamWorksId->id,
                $orderId,
                NotificationType::APPLICATION,
                'تم أسناد طلب جديد رقم ' . $orderId,
                'team-accepted-orders',
                UserType::TEAM_WORK
            );
        }


        $teamWorksTokens = UserDevice::whereIn('user_id', $teamWorksIds)->get();
        $tokens = [];
        foreach($teamWorksTokens as $teamWorksToken){
            $tokens[] = $teamWorksToken->device_token;
        }
        PushNotification::push_notification(
            [
                "target" => $tokens,
                "title" => 'طلب مسند',
                "type" => 'NewAssignedOrder'
            ]
        );
        return $order;
    }

    public function assignCompanyOrder($parameters, $orderId)
    {
        $order = $this->getOrder($orderId);
        $order->company_id = $parameters['company_id'];
        $order->status = 'Accepted';
        $order->is_active = true;
        $order->save();

        if($order)
            CompanyOrder::where('application_id', $orderId)->delete();

        //send push notification to assigned company
        $companyTokens = UserDevice::where('user_id', $parameters['company_id'])->get();
        $tokens = [];
        foreach($companyTokens as $companyToken){
            $tokens[] = $companyToken->device_token;
        }

        PushNotification::push_notification(
            [
                "target" => $tokens,
                "title" => 'طلب مسند',
                "type" => 'NewAssignedOrder'
            ]
        );

        $this->notificationService->create(
            $parameters['company_id'],
            $orderId,
            NotificationType::APPLICATION,
            'تم أسناد طلب جديد رقم ' . $orderId,
            'company-accepted-orders',
            UserType::COMPANY
        );

        return $order;
    }

    public function getOrderAirServices($orderId)
    {
        return ApplicationAirTypeService::where('application_id', $orderId)->get();
    }

    public function updateOrder($parameters, $orderId)
    {
        try {
            $order = Application::findOrFail($orderId);
            $order->update($parameters);
            if($order){
                ApplicationAirTypeService::where('application_id', $orderId)->delete();
                $airTypes = json_decode($parameters['airTypes'], true);
                $serviceTypes = json_decode($parameters['serviceTypes'], true);
                $numbers = json_decode($parameters['numbers'], true);
                for ($i = 0; $i < count($airTypes) ; $i++){
                    $air_type_service = new ApplicationAirTypeService();
                    $air_type_service->application_id = $orderId;
                    $air_type_service->air_type_id = $airTypes[$i];
                    $air_type_service->service_id = $serviceTypes[$i];
                    $air_type_service->number = $numbers[$i];
                    $air_type_service->save();
                }
            }
            return \Response::json(['msg'=>'تم تحديث الطلب بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    public function makeOrder($parameters)
    {
        $airTypes = json_decode($parameters['airTypes'], true);
        $serviceTypes = json_decode($parameters['serviceTypes'], true);
        $numbers = json_decode($parameters['numbers'], true);
        $application = new Application();
        $application->name =$parameters['name'];
        $application->phone =$parameters['phone'];
        $application->region_id =$parameters['region_id'];
        $application->hour_id =$parameters['hour_id'];
        $application->day =date('Y-m-d', strtotime($parameters['day']));
        $user = Application::where('phone', $parameters['phone'])->where('is_active', 1)->first();
        $redirect = 0;
        if($user){
            $redirect = 0;
            $application->status = OrderStatus::PENDING;
            $application->is_active = true;
            $application->save();
//            $this->assignCompanies($application);
        }
        else{
            $redirect = 1;
            $application->status = OrderStatus::SMS_NOT_CONFIRMED;
            //generate confirmation code
            $application->confirmation_code = $this->createRandomConfirmationCode();
            $application->save();
        }
        if($application){
            for ($i = 0; $i < count($airTypes) ; $i++){
                $air_type_service = new ApplicationAirTypeService();
                $air_type_service->application_id = $application->id;
                $air_type_service->air_type_id = $airTypes[$i];
                $air_type_service->service_id = $serviceTypes[$i];
                $air_type_service->number = $numbers[$i];
                $air_type_service->save();
            }
        }
        if($user)
            dispatch(new SendNotificationCompanies($application));
//            $params = array(
//                'application' => $application,
//                '--queue' => 'default'
//            );
//            Artisan::queue('AssignCompaniesToApplication:assignCompaniesToApplication', $params);

        return \Response::json(['msg'=> $application, 'redirect' => $redirect],200);
    }

    /**
     * Create random confirmation code
     * @author Alaa <a.shawkey@friendycar.com>
     *
     * @return string
     */
    public function createRandomConfirmationCode() {
        $randNumbers = rand(100, 999);
        $stringLength = 3 ;
        $randCharacters = substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyz', ceil($stringLength/strlen($x)) )),1,$stringLength);
        return $randNumbers . $randCharacters;
    }

//    Accepted orders
    public function listAcceptedOrders()
    {
        return Application::where('status', OrderStatus::ACCEPTED)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesAccepted($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }

    public function listCompanyAcceptedOrders()
    {
        return Application::where(['status' => 'Accepted', 'company_id' => Auth::user()->id])->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesCompanyAccepted($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns_')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('getInvoice', $data->getInvoice)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'air_number', 'actions'])->make(true);

        return $tableData ;
    }

    //    Cancelled orders
    public function listCancelledOrders()
    {
        return Application::where('status', OrderStatus::CANCELLED)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesCancelled($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }

    //    Hanging orders
    public function listHangingOrders()
    {
        return Application::where('status', OrderStatus::HANGING)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesHanged($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }

    public function listNotAssignedOrders()
    {
        return Application::where('status', OrderStatus::NOT_ASSIGN)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesAssignedOrders($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }

    //    Completed orders
    public function listCompletedOrders()
    {
        return Application::where('status', OrderStatus::COMPLETED)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesCompleted($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }

    public function listCompanyCompletedOrders()
    {
        return Application::where(['status' => 'Completed', 'company_id' => Auth::user()->id])->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesCompanyCompleted($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'air_number'])->make(true);

        return $tableData ;
    }

    //    New orders
    public function listNewOrders()
    {
        return Application::where('status', OrderStatus::PENDING)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }
    public function listSmsNotConfirmedOrders()
    {
        return Application::where('status', OrderStatus::SMS_NOT_CONFIRMED)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesNew($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }
    public function datatablesSms($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }

    public function listCompanyNewOrders()
    {
        return CompanyOrder::where('company_id', Auth::user()->id)->with('getApplication')->get();
    }

    public function datatablesCompanyNew($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (CompanyOrder $application){
                    return $application->getApplication->getRegion->name;
            })
            ->addColumn('air_number', function (CompanyOrder $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->getApplication->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->addColumn('getServiceTypes', function (CompanyOrder $application) {
                $arr = "<ul>";
                if(count($application->getApplication->getServiceTypes) > 0) {
                    foreach ($application->getApplication->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->addColumn('getAirTypes', function (CompanyOrder $application) {
                $arr = "<ul>";
                if(count($application->getApplication->getAirTypes) > 0) {
                    foreach ($application->getApplication->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns_')->with('controller','orders')
                    ->with('id', $data->getApplication->id)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }

    //    New orders
    public function listUnderAppraisalOrders()
    {
        return Application::where('status', OrderStatus::UNDER_APPRAISAL)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesUnderAppraisal($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('rate', $data->status)
                    ->with('status', $data->status)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'actions', 'air_number'])->make(true);

        return $tableData ;
    }

    public function listTeamAcceptedOrders()
    {
        return Application::where(['status' => 'Accepted', 'company_id' => Auth::user()->company_id])->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesTeamAccepted($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns_')->with('controller','orders')
                    ->with('id', $data->id)
                    ->with('getInvoice', $data->getInvoice)
                    ->render();
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'air_number', 'actions'])->make(true);

        return $tableData ;
    }

    public function listTeamCompletedOrders()
    {
        return Application::where(['status' => 'Completed', 'company_id' => Auth::user()->company_id])->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesTeamCompleted($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'air_number'])->make(true);

        return $tableData ;
    }

    public function listOrdersRated()
    {
        return Application::where('rate', ApplicationRate::RATED)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesOrdersRated($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.ratedActionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->render();
            })
            ->rawColumns(['actions', 'region', 'getServiceTypes', 'getAirTypes', 'company', 'air_number'])->make(true);

        return $tableData ;
    }

    public function listOpenedNotRated()
    {
        return Application::where('rate', ApplicationRate::OPENED_NOT_RATED)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesOpenedNotRated($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'air_number'])->make(true);

        return $tableData ;
    }

    public function listLinkNotOpened()
    {
        return Application::where('rate', ApplicationRate::NOT_OPENED)->with(array('getServiceTypes' => function($query){$query->select('name');}, 'getAirTypes' => function($query){$query->select('type');}))->get();
    }

    public function datatablesLinkNotOpened($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('region', function (Application $application){
                if($application->getRegion)
                    return $application->getRegion->name;
            })
            ->addColumn('company', function (Application $application){
                if($application->getCompany)
                    return $application->getCompany->name;
            })
            ->addColumn('air_number', function (Application $application){
                $arr = "<ul>";
                $numbers = $this->airTypesNumber($application->id);
                foreach ($numbers as $number) {

                    $arr .= '<li>' . $number->number . ' ' . 'مكيف ' . '</li>';
                }
                $arr .= '</ul>';
                return $arr;
            })
            ->editColumn('getServiceTypes', function ($serviceTypes) {
                $arr = "<ul>";
                if(count($serviceTypes->getServiceTypes) > 0) {
                    foreach ($serviceTypes->getServiceTypes as $service) {

                        $arr .= '<li>' . $service->name . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد خدمه';
                }
            })
            ->editColumn('getAirTypes', function ($getAirTypes) {
                $arr = "<ul>";
                if(count($getAirTypes->getAirTypes) > 0) {
                    foreach ($getAirTypes->getAirTypes as $type) {

                        $arr .= '<li>' . $type->type . '</li>';
                    }
                    $arr .= '</ul>';
                    return $arr;
                }else{
                    return 'لا توجد نوع';
                }
            })
            ->rawColumns(['region', 'getServiceTypes', 'getAirTypes', 'company', 'air_number'])->make(true);

        return $tableData ;
    }
}
