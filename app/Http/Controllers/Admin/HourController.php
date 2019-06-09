<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Services\CountryService;
use Illuminate\Http\Request;
use App\Services\HourService;
use Response;

class HourController extends AbstractController {

    public $hourService;
    public function __construct(HourService $hourService)
    {
        $this->middleware('auth');
        $this->hourService = $hourService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $hours  = $this->hourService->listHours();
        $tableData = $this->hourService->datatables($hours);

        if($request->ajax())
            return $tableData;

        return view('hours.index')
              ->with('modal', 'hours')
              ->with('modal_', 'الوقت')
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
        $hour = $this->hourService->createHour($data);
        return $hour;
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
        $hour = $this->hourService->getHour($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $hour->toJson()]);
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
        $hour = $this->hourService->updateHour($data, $id);

        return $hour;
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
        $hour = $this->hourService->deleteHour($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }
}
