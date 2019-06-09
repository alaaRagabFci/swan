<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\TheServiceService;
use Response;

class ServiceController extends AbstractController {

    public $theServiceService;
    public function __construct(TheServiceService $theServiceService)
    {
        $this->middleware('auth');
        $this->theServiceService = $theServiceService;
    }

    /**
     * List all users.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $categories  = $this->theServiceService->listServices();
        $tableData = $this->theServiceService->datatables($categories);

        if($request->ajax())
            return $tableData;

        return view('services.index')
              ->with('modal', 'services')
              ->with('modal_', 'خدمه')
              ->with('tableData', $tableData);
    }

    /**
     * Update user.
     * requirements={
     *      {"name"="icon", "dataType"="String", "requirement"="\d+", "description"="user icon"},
     *      {"name"="phone", "dataType"="String", "requirement"="\d+", "description"="phone"},
     *      {"name"="username", "dataType"="String", "requirement"="\d+", "description"="username"},
     *      {"name"="display_name", "dataType"="String", "requirement"="\d+", "description"="display_name"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function store(Request $request)
    {
        $data  = $request->all();
        $data['icon'] = $request->hasFile('icon') ? $request->file('icon') : "";
        $service = $this->theServiceService->createService($data);
        return $service;
    }
    /**
     * Edit user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function edit(Request $request , $id)
    {
        $service = $this->theServiceService->getService($id);
        session(['service_id'     => $service->id]);
        session(['icon'  => $service->icon]);
        return Response::json(['msg'=>'Adding Successfully','data'=> $service->toJson()]);
    }

    /**
     * Update user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"},
     *      {"name"="icon", "dataType"="String", "requirement"="\d+", "description"="user icon"},
     *      {"name"="phone", "dataType"="String", "requirement"="\d+", "description"="phone"},
     *      {"name"="username", "dataType"="String", "requirement"="\d+", "description"="username"},
     *      {"name"="display_name", "dataType"="String", "requirement"="\d+", "description"="display_name"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function update(Request $request)
    {
        $icons['icon'] = $request->hasFile('icon') ? $request->file('icon') : "";
        $data  = $request->all();

        $service = $this->theServiceService->updateService(
            session('service_id'), $data, $icons ,session('icon')
        );

        return $service;
    }

    /**
     * Delete user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function destroy(Request $request, $id)
    {
        $service = $this->theServiceService->deleteService($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function sortServices(Request $request)
    {
        $data  = $request->all();
        $service = $this->theServiceService->sortServices($data);

        return $service;
    }
}
