<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Service;
use App\Services\UtilityService;

class TheServiceService
{
    private $utilityService;
    public function __construct(UtilityService $utilityService){
        $this->utilityService = $utilityService;
    }

    /**
     * List all Services.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listServices()
    {
        return Service::get();
    }

    /**
     * Datatebles
     * @param $Services
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($services)
    {
        $tableData = Datatables::of($services)
            ->editColumn('icon', '<a href="javascript:;"><img src="{{ config("app.baseUrl").$icon }}" class="image" width="50px" height="50px"></a>')
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','services')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'icon'])->make(true);

        return $tableData ;
    }

    /**
     * Get description.
     * @param $serviceId
     * @return Service
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getService($serviceId)
    {
        try {
            $service = Service::findOrFail($serviceId);
            return $service;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Service not found');
        }
    }

    public function sortServices($ids)
    {
        for($i = 0; $i < count($ids); $i++){
            $service = Service::findOrFail($ids[$i]);
            $service->sort = $i+1;
            $service->save();
        }
    }

    /**
     * Create description.
     * @param $type
     * @param $username
     * @param $display_name
     * @param $phone
     * @param $image
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function createService($parameters)
    {
        try {
            if(isset($parameters['icon']) && $parameters['icon'] != ""){
                $data = $this->utilityService->uploadImage($parameters['icon']);
                if(!$data['status'])
                    return response(array('msg' => $data['errors']), 404);
                $parameters['icon'] = $data['image'];
            }else{
                return response(array('msg' => 'Image required'), 404);
            }

            if(Service::where('name', $parameters['name'])->first())
                return \Response::json(['msg'=>'هذه الخدمه موجود بالفعل'],404);

            $service = new Service();
            $service->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Update user.
     * @param $username
     * @param $display_name
     * @param $phone
     * @param $image
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateService($serviceId, $parameters, $icons, $icon)
    {
        try {
            $Service = Service::findOrFail($serviceId);
            if(isset($icons['icon']) && $icons['icon'] != ""){
                $data = $this->utilityService->uploadImage($icons['icon']);
                if(!$data['status'])
                    return response(array('msg' => $data['errors']), 404);
                $parameters['icon'] = $data['image'];
            }else{
                $parameters['icon']  = $icon;
            }

            if(Service::where('name', $parameters['name'])->where('id', '!=', $serviceId)->first())
                return \Response::json(['msg'=>'هذه الخدمه موجود بالفعل'],404);

            $Service->update($parameters);
            return \Response::json(['msg'=>'تم التحديث بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Delete Service.
     * @param $ServiceId
     * @return Service
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteService($ServiceId)
    {
        return Service::find($ServiceId)->delete();
    }
}
