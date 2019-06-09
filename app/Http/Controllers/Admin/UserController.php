<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Services\RegionService;
use Response;

class UserController extends AbstractController {

    public $userService, $regionService, $categoryService;
    public function __construct(UserService $userService, CategoryService $categoryService, RegionService $regionService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->regionService = $regionService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $categories  = $this->categoryService->listCategories();
        $regions  = $this->regionService->listRegions();
        $users  = $this->userService->listCompanies();
        $tableData = $this->userService->datatables($users);

        if($request->ajax())
            return $tableData;

        return view('companies.index')
              ->with('modal', 'companies')
              ->with('categories', $categories)
              ->with('regions', $regions)
              ->with('modal_', 'شركه')
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
        $user = $this->userService->createCompany($data);
        return $user;
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
        $user = $this->userService->getCompany($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $user->toJson()]);
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
        $user = $this->userService->updateCompany($data, $id);

        return $user;
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
        $user = $this->userService->deleteCompany($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function changePassword(Request $request, $id){
        $company = $this->userService->getCompany($id);
        return $this->userService->changePassword($company, $request->all());
    }
}
