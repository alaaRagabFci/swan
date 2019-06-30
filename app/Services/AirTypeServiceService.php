<?php

namespace App\Services;
use App\Models\ApplicationAirTypeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\ServicePriceDetails;

class AirTypeServiceService
{
    public $logService;
    public function __construct(LogService $logService){
        $this->logService = $logService;
    }

    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listServicePriceDetails()
    {
        return ServicePriceDetails::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($servicePriceDetails)
    {
        $tableData = Datatables::of($servicePriceDetails)
            ->addColumn('airType', function (ServicePriceDetails $servicePriceDetail){
                return $servicePriceDetail->getAirType->type;
            })
            ->addColumn('serviceType', function (ServicePriceDetails $servicePriceDetail){
                return $servicePriceDetail->getService->name;
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','air-type-service-prices')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'airType', 'serviceType'])->make(true);

        return $tableData ;
    }

    public function addService($parameters)
    {
        $service = new ApplicationAirTypeService();
        $service->application_id = $parameters['orderId'];
        $service->service_id = $parameters['service_id'];
        $service->air_type_id = $parameters['air_type_id'];
        $service->number = $parameters['number'];
        $service->save();

        $this->logService->createLog(\Auth::user()->id, 'Application', $parameters['orderId'],  ' تم أضافة خدمة جديده رقم '. $service->id );

        return $service;

    }

    /**
     * Create client.
     * @param $clientId
     * @param $title_ar
     * @param $title_en
     * @param $description_ar
     * @param $description_en
     * @param $icon
     * @param $page
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function createServicePrice($parameters)
    {
        try {
//            if(ServicePriceDetails::where(['air_type_id'=> $parameters['air_type_id'], 'service_id' => $parameters['service_id']])->first())
//                return \Response::json(['msg'=>'هذا السعر موجود بالفعل'],404);

            $servicePriceDetail = new ServicePriceDetails();
            $servicePriceDetail->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Get ServicePriceDetailss.
     * @param $servicePriceDetailsId
     * @return ServicePriceDetailss
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getServicePriceDetail($servicePriceId)
    {
        try {
            $servicePriceDetail = ServicePriceDetails::findOrFail($servicePriceId);
            return $servicePriceDetail;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'ServicePrice not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $servicePriceDetailsname
     * @return ServicePriceDetailss
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateServicePriceDetails($parameters, $servicePriceId)
    {
        try {
//            if(ServicePriceDetails::where(['air_type_id'=> $parameters['air_type_id'], 'service_id' => $parameters['service_id']])->where('id', '!=', $servicePriceId)->first())
//                return \Response::json(['msg'=>'هذا الحي موجود بالفعل'],404);

            $servicePriceDetail = ServicePriceDetails::findOrFail($servicePriceId);
            $servicePriceDetail->update($parameters);
            return \Response::json(['msg'=>'تم تحديث الحي بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Delete client.
     * @param $clientId
     * @return Client
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteServicePriceDetails($servicePriceId)
    {
        return ServicePriceDetails::find($servicePriceId)->delete();
    }
}
