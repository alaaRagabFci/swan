<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Services\AirTypeService;
use App\Services\TheServiceService;
use Illuminate\Http\Request;
use App\Services\AirTypeServiceService;
use Response;

class AirTypeServiceController extends AbstractController {

    public $airTypeServiceService, $airTypeService, $theServiceService;
    public function __construct(AirTypeServiceService $airTypeServiceService, AirTypeService $airTypeService, TheServiceService $theServiceService)
    {
        $this->middleware('auth');
        $this->airTypeServiceService = $airTypeServiceService;
        $this->theServiceService = $theServiceService;
        $this->airTypeService = $airTypeService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $airTypes  = $this->airTypeService->listAirTypes();
        $services  = $this->theServiceService->listServices();
        $airTypesServices  = $this->airTypeServiceService->listServicePriceDetails();
        $tableData  = $this->airTypeServiceService->datatables($airTypesServices);

        if($request->ajax())
            return $tableData;

        return view('air-type-service-prices.index')
              ->with('airTypes', $airTypes)
              ->with('services', $services)
              ->with('modal', 'air-type-service-prices')
              ->with('modal_', 'سعر الخدمات')
              ->with('tableData', $tableData);
    }

    public function addService(Request $request)
    {
        $parameters = $request->all();
        $service = $this->airTypeServiceService->addService($parameters);
        return $service;
    }

    /**
     * Update client.
     * requirements={
     *      {"name"="name_ar", "dataType"="String", "requirement"="\d+", "description"="client name ar"},
     *      {"name"="name_en", "dataType"="String", "requirement"="\d+", "description"="client name en"},
     *      {"name"="type", "dataType"="String", "requirement"="\d+", "description"="client type"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function store(Request $request)
    {
        $data  = $request->all();
        $servicePrice = $this->airTypeServiceService->createServicePrice($data);
        return $servicePrice;
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
        $servicePrice = $this->airTypeServiceService->getServicePriceDetail($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $servicePrice->toJson()]);
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
        $servicePrice = $this->airTypeServiceService->updateServicePriceDetails($data, $id);

        return $servicePrice;
    }

    /**
     * Delete client.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="client id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function destroy(Request $request, $id)
    {
        $servicePrice = $this->airTypeServiceService->deleteServicePriceDetails($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }
}
