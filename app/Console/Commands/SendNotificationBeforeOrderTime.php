<?php

namespace App\Console\Commands;

use App\Constants\NotificationType;
use App\Constants\OrderStatus;
use App\Constants\UserType;
use App\Models\Application;
use App\Models\Setting;
use App\Models\UserDevice;
use App\Services\NotificationService;
use App\User;
use Illuminate\Console\Command;
use App\Helpers\PushNotification;

class SendNotificationBeforeOrderTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendNotificationBeforeOrderTime:sendNotifficationBeforeOrderTime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SendNotificationBeforeOrderTime';

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
        $setting = Setting::first();
        $orders = Application::where('status', OrderStatus::ACCEPTED)->get();
        foreach($orders as $order){
            $timeNow = strtotime(date("Y-m-d H:i:s"));
            $order->appointment = strtotime($order->day .' '.$order->getHour->hour);
            $diff = round(abs($order->appointment - $timeNow) / 60,2);
            if($diff <= $setting->notify_time){
                //send notification to companies & ream works to remember them
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
                        "title" => ' يتبقي أقل من ' . $setting->notify_time . ' دقائق علي ميعاد الطلب ' ,
                        "type" => 'RememberOrder'
                    ]
                );

                $notificationService = new NotificationService();
                foreach($teamWorksIds as $teamWorksId){
                    $notificationService->create(
                        $teamWorksId->id,
                        $order->id,
                        NotificationType::APPLICATION,
                        ' يتبقي أقل من ' . $setting->notify_time . ' دقائق علي ميعاد الطلب ',
                        'team-accepted-orders',
                        UserType::TEAM_WORK
                    );
                }

                $notificationService->create(
                    $order->company_id,
                    $order->id,
                    NotificationType::APPLICATION,
                   ' يتبقي أقل من ' . $setting->notify_time . ' دقائق علي ميعاد الطلب ',
                   'company-accepted-orders',
                    UserType::COMPANY
                    );

                echo 'Notification sent successfully!!';
            }else{
                echo 'Not yet';
            }
        }
    }
}
