<?php

namespace App\Console\Commands;

use App\Constants\OrderStatus;
use App\Models\Application;
use App\Models\CompanyOrder;
use App\Models\Setting;
use App\Models\UserDevice;
use App\Services\NotificationService;
use App\User;
use Illuminate\Console\Command;
use App\Helpers\PushNotification;

class SendNotificationNotAssignedOrderTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendNotificationNotAssignedOrderTime:sendNotificationNotAssignedOrderTime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SendNotificationNotAssignedOrderTime';

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
        $orders = Application::where('status', OrderStatus::PENDING)->orWhere('status', OrderStatus::SMS_NOT_CONFIRMED)->get();
        foreach($orders as $order){
            $timeNow = strtotime(date("Y-m-d H:i:s"));
            $appointment = strtotime($order->day .' '.$order->getHour->hour);
            if($appointment <= $timeNow){
                $order->status = OrderStatus::NOT_ASSIGN;
                $order->save();
                if($order)
                    CompanyOrder::where('application_id', $order->id)->delete();
                echo 'Status changed successfully!!';
            }else{
                echo 'Not yet';
            }
        }
    }
}
