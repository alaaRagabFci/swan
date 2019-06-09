<?php

namespace App\Providers;

use App\Constants\OrderStatus;
use App\Models\AirType;
use App\Models\CompanyOrder;
use App\Models\Setting;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Application;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\View;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view)
        {
            if (Auth::check()){
                $teams = User::where('company_id', Auth::id())->count();
                $applicationCompanyPending = CompanyOrder::where('company_id' ,Auth::id())->count();
                $applicationCompanyCompleted = Application::where(['status' => 'Completed', 'company_id' => Auth::id()])->count();
                view()->share('teams', $teams);
                view()->share('applicationCompanyPending', $applicationCompanyPending);
                view()->share('applicationCompanyCompleted', $applicationCompanyCompleted);
            }
        });

        Schema::defaultStringLength(191);

        $airTypes  = AirType::get();
        $serviceTypes  = Service::get();

        $applicationPending = Application::where('status', OrderStatus::PENDING)->count();
        $applicationCompleted = Application::where('status', OrderStatus::COMPLETED)->count();
        $applicationCancelled = Application::where('status', OrderStatus::CANCELLED)->count();

        $categories = Category::count();
        $services = Service::count();

        $setting = Setting::first();


        $companies = array();
        view()->share('applicationCompleted', $applicationCompleted);
        view()->share('applicationPending', $applicationPending);
        view()->share('applicationCancelled', $applicationCancelled);
        view()->share('categories', $categories);
        view()->share('services', $services);
        view()->share('companies', $companies);
        view()->share('setting', $setting);
        view()->share('airTypes', $airTypes);
        view()->share('serviceTypes', $serviceTypes);
    }
}
