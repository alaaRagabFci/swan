<?php

namespace App\Console\Commands;

use App\Constants\NotificationType;
use App\Constants\OrderStatus;
use App\Constants\UserType;
use App\Models\Application;
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
    protected $signature = 'AssignCompaniesToApplication:assignCompaniesToApplication {application} {--queue}';

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

    protected function getArguments()
    {
        return array(
            array('application', InputArgument::REQUIRED, 'Application object' ),
        );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $args = $this->arguments();
        $application = $args['application'];
        $categoryService = new CategoryService();
        $categories = $categoryService->listCategories();
        foreach ($categories as $category){
            $companies = User::where('category_id', $category->id)->get();
            if($application['status'] != OrderStatus::ACCEPTED){
                foreach ($companies as $company){
                    $companyOrder = new CompanyOrder();
                    $companyOrder->company_id = $company->id;
                    $companyOrder->application_id = $application['id'];
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
                        $application['id'],
                        NotificationType::APPLICATION,
                        'تم أسناد طلب جديد رقم ' . $application['id'],
                        'company-new-orders',
                        UserType::COMPANY
                    );
                    //sleep time if status still pending loop again
                    $setting = Setting::first();
                    sleep($setting->waiting_order_time * 60); //continue
                }
            }
            else{
                break;
            }
        }
        return 'true';
    }
}
