<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\SettingService;
use Response;

class SettingController extends AbstractController {

    public $settingService;
    public function __construct(SettingService $settingService)
    {
        $this->middleware('auth');
        $this->settingService = $settingService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $settings  = $this->settingService->listSettings();
        $tableData = $this->settingService->datatables($settings);

        if($request->ajax())
            return $tableData;

        return view('settings.index')
              ->with('modal', 'settings')
              ->with('tableData', $tableData);
    }

    /**
     * Edit client.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="client id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function edit(Request $request , $id)
    {
        $country = $this->settingService->getSetting($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $country->toJson()]);
    }

    /**
     * Update client.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="client id"},
     *      {"name"="name_ar", "dataType"="String", "requirement"="\d+", "description"="client name ar"},
     *      {"name"="name_en", "dataType"="String", "requirement"="\d+", "description"="client name en"},
     *      {"name"="type", "dataType"="String", "requirement"="\d+", "description"="client type"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $country = $this->settingService->updateSetting($data, $id);

        return $country;
    }
}
