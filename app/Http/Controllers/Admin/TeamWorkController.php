<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\TeamWorkService;
use App\Services\RegionService;
use Response;

class TeamWorkController extends AbstractController {

    public $teamWorkService, $regionService;
    public function __construct(TeamWorkService $teamWorkService, RegionService $regionService)
    {
        $this->middleware('auth');
        $this->teamWorkService = $teamWorkService;
        $this->regionService = $regionService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $regions  = $this->regionService->listRegions();
        $teamWorks  = $this->teamWorkService->listTeams();
        $tableData = $this->teamWorkService->datatables($teamWorks);

        if($request->ajax())
            return $tableData;

        return view('team-works.index')
              ->with('modal', 'team-works')
              ->with('regions', $regions)
              ->with('modal_', 'فريق عمل')
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
        $teamWork = $this->teamWorkService->createTeamWork($data);
        return $teamWork;
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
        $teamWork = $this->teamWorkService->getTeamWork($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $teamWork->toJson()]);
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
        $teamWork = $this->teamWorkService->updateTeamWork($data, $id);

        return $teamWork;
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
        $teamWork = $this->teamWorkService->deleteTeamWork($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function changePassword(Request $request, $id){
        $company = $this->teamWorkService->getTeamWork($id);
        return $this->teamWorkService->changePassword($company, $request->all());
    }
}
