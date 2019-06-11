<?php

namespace App\Jobs;

use App\Constants\NotificationType;
use App\Constants\OrderStatus;
use App\Constants\UserType;
use App\Helpers\PushNotification;
use App\Models\Application;
use App\Models\CompanyOrder;
use App\Models\Setting;
use App\Models\UserDevice;
use App\Services\CategoryService;
use App\Services\NotificationService;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationCompanies implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $application;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $categoryService = new CategoryService();
        $category = $categoryService->getFirstCategory();
        if($category){
            $companies = User::where('category_id', $category->id)->get();
            $nextCategory = $categoryService->getNextCategory($category);
            if($this->application['status'] != OrderStatus::ACCEPTED){
                foreach ($companies as $company){
                    $companyOrder = new CompanyOrder();
                    $companyOrder->company_id = $company->id;
                    $companyOrder->category_id = $nextCategory ? $nextCategory->id : null;
                    $companyOrder->application_id = $this->application['id'];
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
                        $this->application['id'],
                        NotificationType::APPLICATION,
                        'تم أسناد طلب جديد رقم ' . $this->application['id'],
                        'company-new-orders',
                        UserType::COMPANY
                    );
                }
            }
        }
    }
}
