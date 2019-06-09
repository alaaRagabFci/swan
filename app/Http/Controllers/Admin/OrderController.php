<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Services\AirTypeService;
use App\Services\RegionService;
use App\Services\TheServiceService;
use App\Services\UserService;
use App\Services\HourService;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\NotificationService;
use Response;

class OrderController extends AbstractController {

    public $orderService, $regionService, $theServiceService, $airTypeService, $userService, $notificationService ;
    public function __construct(NotificationService $notificationService, UserService $userService, HourService $hourService, OrderService $orderService, RegionService $regionService, TheServiceService $theServiceService, AirTypeService $airTypeService)
    {
        $this->middleware('auth');
        $this->orderService = $orderService;
        $this->regionService = $regionService;
        $this->theServiceService = $theServiceService;
        $this->userService = $userService;
        $this->airTypeService = $airTypeService;
        $this->hourService = $hourService;
        $this->notificationService = $notificationService;
    }

    public function index(Request $request)
    {
        $orders  = $this->orderService->listAllOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatables($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.all')
              ->with('modal', 'orders')
              ->with('companies', $companies)
              ->with('tableData', $tableData);
    }

    public function edit(Request $request , $id)
    {
        $order = $this->orderService->getOrder($id);
        $regions  = $this->regionService->listRegions();
        $hours  = $this->hourService->listHours();
        $airTypes  = $this->airTypeService->listAirTypes();
        $services  = $this->theServiceService->listServices();
        $orderAirServices = $this->orderService->getOrderAirServices($id);
        return view('orders.form_')
            ->with('regions', $regions)
            ->with('hours', $hours)
            ->with('airTypes', $airTypes)
            ->with('services', $services)
            ->with('orderAirServices', $orderAirServices)
            ->with('order', $order);
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $order = $this->orderService->updateOrder($data, $id);

        return $order;
    }

    public function acceptOrders(Request $request)
    {
        $orders  = $this->orderService->listAcceptedOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesAccepted($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.accept')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function cancelledOrders(Request $request)
    {
        $orders  = $this->orderService->listCancelledOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesCancelled($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.cancelled')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function hangingOrders(Request $request)
    {
        $orders  = $this->orderService->listHangingOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesHanged($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.hanging')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function completedOrders(Request $request)
    {
        $orders  = $this->orderService->listCompletedOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesCompleted($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.complete')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function newOrders(Request $request)
    {
        $orders  = $this->orderService->listNewOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesNew($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.new')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }
    public function smsNotConfirmedOrders(Request $request)
    {
        $orders  = $this->orderService->listSmsNotConfirmedOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesSms($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.sms')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function underAppraisalOrders(Request $request)
    {
        $orders  = $this->orderService->listUnderAppraisalOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesUnderAppraisal($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.under-appraisal')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function changeOrderStatus(Request $request, $id, $status, $reason = null)
    {
        $order = $this->orderService->changeOrderStatus($id, $status, $reason);
        return $order;
    }

    public function assignCompanyOrder(Request $request)
    {
        $parameters = $request->all();
        $order = $this->orderService->assignCompanyOrder($parameters, $parameters['order_id']);
        return $order;
    }

    public function getOrderDetails(Request $request, $id){
        $details  = $this->orderService->getOrderDetails($id);
        $tableData = $this->orderService->datatablesRate($details);

        return view('orders.details')
            ->with('tableData_', $tableData);
    }

    public function getInvoiceDetails(Request $request, $id){
        $details  = $this->orderService->getInvoiceDetails($id);
        $tableData = $this->orderService->datatablesInvoiceDetails($details);

        return view('orders.invoice-details')
            ->with('tableData_', $tableData);
    }

    public function companyAcceptOrders(Request $request)
    {
        $orders  = $this->orderService->listCompanyAcceptedOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesCompanyAccepted($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.company-accept')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function companyCompletedOrders(Request $request)
    {
        $orders  = $this->orderService->listCompanyCompletedOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesCompanyCompleted($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.company-complete')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function companyNewOrders(Request $request)
    {
        $orders  = $this->orderService->listCompanyNewOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesCompanyNew($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.company-new')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function agreeOrder(Request $request, $id)
    {
        $order = $this->orderService->agreeOrder($id);
        return $order;
    }

    public function notAssignedOrders(Request $request)
    {
        $orders  = $this->orderService->listNotAssignedOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesAssignedOrders($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.not-assigned')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function teamAcceptOrders(Request $request)
    {
        $orders  = $this->orderService->listTeamAcceptedOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesTeamAccepted($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.team-accept')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function teamCompletedOrders(Request $request)
    {
        $orders  = $this->orderService->listTeamCompletedOrders();
        $companies  = $this->userService->listCompanies();
        $tableData = $this->orderService->datatablesTeamCompleted($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.team-complete')
            ->with('companies', $companies)
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function openedNotRated(Request $request)
    {
        $orders  = $this->orderService->listOpenedNotRated();
        $tableData = $this->orderService->datatablesOpenedNotRated($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.opened-not-rated')
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function ordersRated(Request $request)
    {
        $orders  = $this->orderService->listOrdersRated();
        $tableData = $this->orderService->datatablesOrdersRated($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.rated')
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function linkNotOpened(Request $request)
    {
        $orders  = $this->orderService->listLinkNotOpened();
        $tableData = $this->orderService->datatablesLinkNotOpened($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.link-not-opened ')
            ->with('modal', 'orders')
            ->with('tableData', $tableData);
    }

    public function updateNotificationsSeen(Request $request, $id){
        return $this->notificationService->updateReadNotifications($id);
    }
}
