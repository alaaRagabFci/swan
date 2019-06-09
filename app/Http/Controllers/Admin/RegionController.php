<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Services\CountryService;
use Illuminate\Http\Request;
use App\Services\RegionService;
use Response;

class RegionController extends AbstractController {

    public $regionService, $countryService;
    public function __construct(RegionService $regionService, CountryService $countryService)
    {
        $this->middleware('auth');
        $this->regionService = $regionService;
        $this->countryService = $countryService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $countries  = $this->countryService->listCountries();
        $regions  = $this->regionService->listRegions();
        $tableData = $this->regionService->datatables($regions);

        if($request->ajax())
            return $tableData;

        return view('regions.index')
              ->with('countries', $countries)
              ->with('modal', 'regions')
              ->with('modal_', 'الأحياء')
              ->with('tableData', $tableData);
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
        $region = $this->regionService->createRegion($data);
        return $region;
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
        $region = $this->regionService->getRegion($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $region->toJson()]);
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
        $region = $this->regionService->updateRegion($data, $id);

        return $region;
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
        $region = $this->regionService->deleteRegion($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }
}
