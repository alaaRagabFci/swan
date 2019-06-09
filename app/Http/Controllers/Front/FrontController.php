<?php namespace App\Http\Controllers\Front;

use App\Constants\NotificationType;
use App\Constants\UserType;
use App\Models\AirType;
use App\Models\Application;
use App\Models\ApplicationAirTypeService;
use App\Models\Email;
use App\Models\Hour;
use App\Models\Invoice;
use App\Models\Region;
use App\Models\Service;
use App\Models\UserRate;
use App\Services\NotificationService;
use App\Services\OrderService;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class FrontController {

    public $orderService;
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    //homePage
    public function home()
    {
        return view('front.index');
    }

    public function contactUs()
    {
        return view('front.contact');
    }

    public function checkOrderStatus()
    {
        return view('front.check-order-status');
    }

    public function checkPhone(Request $request)
    {
        $parameters = $request->all();
//        var_dump($parameters); die;
        $applications = Application::where('phone', $parameters['phone'])->orderby('id', 'DESC')->get();
        if(count($applications) > 0){
            return view('front.order-status', compact('applications'));
        }
        else{
            return redirect()->back()->with('message', 'رقم الجوال خطأ');
        }
    }

    public function cancelOrder($id, $status, $reason = null)
    {
        $order = $this->orderService->cancelOrder($id, $status, $reason);
        return $order;
    }

    public function orderNow()
    {
        $airTypes = AirType::get();
        $services = Service::get();
        $regions = Region::get();
        $hours = Hour::get();
        return view('front.order-now')
               ->with('hours', $hours)
               ->with('airTypes', $airTypes)
               ->with('regions', $regions)
               ->with('services', $services);
    }

    public function getRatePage($id)
    {
        $getRate = UserRate::where('application_id', $id)->first();
        $invoiceTotal = Invoice::where('application_id', $id)->first();
        $application = ApplicationAirTypeService::where('application_id', $id)->get();
        return view('front.thanks',compact('application', 'invoiceTotal', 'id', 'getRate'));
    }

    //send message
    public function sendMessage(Request $request)
    {
        $parameters = $request->all();
        $email = Email::create($parameters);
        if($email){
            $admin = User::where('type', UserType::ADMIN)->first();
            $notificationService = new NotificationService();
            $notificationService->create(
            $admin->id,
            null,
            NotificationType::CONTACTUS,
            'رساله جديدة',
            'contacts',
            UserType::ADMIN
            );
        }
        $success = 'تم الأرسال بنجاح';
        return redirect()->back()->with('message', $success);
    }

    //send message
    public function rateApplication(Request $request)
    {
        $parameters = $request->all();
        $application = Application::find($parameters['orderId']);
        $rate = new UserRate();
        $rate->comment = $parameters['comment'];
        $rate->rate = $parameters['ratings'][0];
        $rate->application_id = $parameters['orderId'];
        $rate->company_id = $application->getCompany->id;
        $rate->save();
        $success = 'تم التقييم بنجاح';
        return redirect()->back()->with('message', $success);
    }

    public function makeOrder(Request $request){
        $data  = $request->all();
        $order = $this->orderService->makeOrder($data);
        return $order;
    }

    public function verifyNumber(Request $request){
        $data  = $request->all();
        $order = $this->orderService->verifyNumber($data);
        return $order;
    }

    public function getPriceRange($totalNumbers, $serviceId, $airTypeId){
        $price = $this->orderService->getRange($totalNumbers, $serviceId, $airTypeId);
        return $price->price;
    }
 }
