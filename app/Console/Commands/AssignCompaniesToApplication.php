<?php

namespace App\Console\Commands;

use App\Constants\NotificationType;
use App\Constants\OrderStatus;
use App\Constants\UserType;
use App\Models\Application;
use App\Models\Category;
use App\Models\CompanyOrder;
use App\Models\Setting;
use App\Models\UserDevice;
use App\Services\CategoryService;
use App\Services\NotificationService;
use App\User;
use Illuminate\Console\Command;
use App\Helpers\PushNotification;
use Symfony\Component\Console\Input\InputArgument;

class AssignCompaniesToApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AssignCompaniesToApplication:assignCompaniesToApplication';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AssignCompaniesToApplication';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Africa/Cairo');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get apllication status equal pending
        $applications = Application::where('status', OrderStatus::PENDING)->get();
        $setting = Setting::first();
        $checkIfExist = 0;
        $nextCategory = null;
        $categoryService = new CategoryService();
        foreach ($applications as $application){
            $companyOrder = CompanyOrder::where('application_id', $application->id)->orderBy('id', 'DESC')->first();
            if($companyOrder->category_id){
                $category = Category::find($companyOrder->category_id);
                $nextCategory = $categoryService->getNextCategory( $category );
                if($nextCategory){
                    $compOrder = CompanyOrder::where(['application_id' => $application->id, 'category_id' => $nextCategory->id])->first();
                    if($compOrder)
                        $checkIfExist = 1;
                }
            }
            $timeNow = strtotime(date("Y-m-d H:i:s"));
            $createdAt = strtotime($companyOrder->created_at);
            $diff = round(abs($createdAt - $timeNow) / 60,2);
            if( !$checkIfExist && $diff >= $setting->waiting_order_time && $companyOrder->category_id ){
                $companies = User::where('category_id', $companyOrder->category_id)->get();
                if(count($companies) == 0){
                    $nextCategory_ = $categoryService->getNextCategory( $category );
                    if($nextCategory_) {
                        $companies = User::where('category_id', $nextCategory_->id)->get();
                        $nextCategory = $categoryService->getNextCategory($nextCategory_);
                    }
                }
                foreach ($companies as $company){
                    $companyOrder = new CompanyOrder();
                    $companyOrder->company_id = $company->id;
                    $companyOrder->application_id = $application->id;
                    $companyOrder->category_id = $nextCategory ? $nextCategory->id : null;
                    $companyOrder->save();

                    //send push notification to assigned company
                    $companyTokens = UserDevice::where('user_id', $company->id)->get();
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

                    $notificationService = new NotificationService();
                    $notificationService->create(
                        $company->id,
                        $application->id,
                        NotificationType::APPLICATION,
                        'تم أسناد طلب جديد رقم ' . $application->id,
                        'company-new-orders',
                        UserType::COMPANY
                    );
                }
            }
        }
    }
}
