<?php

namespace App\Services;
use App\Constants\UserType;
use App\Models\TeamWorkDevice;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use Yajra\Datatables\Datatables as Datatables;

class TeamWorkService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listTeams()
    {
        return User::where('type' , UserType::TEAM_WORK)->get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($teamWorks)
    {
        $tableData = Datatables::of($teamWorks)
            ->addColumn('is_active', function (User $teamWork){
                if($teamWork->is_active)
                    return '<span class="label label-sm label-primary"> مفعل </span>';
                else
                    return '<span class="label label-sm label-warning"> غير مفعل </span>';
            })
            ->addColumn('category', function (User $teamWork){
                if($teamWork->getCompany->getCategory)
                    return $teamWork->getCompany->getCategory->name;
            })
            ->addColumn('region', function (User $teamWork){
                if($teamWork->getRegion)
                    return $teamWork->getRegion->name;
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','team-works')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'is_active', 'category', 'region'])->make(true);

        return $tableData ;
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
    public function createTeamWork($parameters)
    {
        try {
            if(User::where('name', $parameters['name'])->first())
                return \Response::json(['msg'=>'أسم الفريق موجود بالفعل'],404);

            if(User::where('phone', $parameters['phone'])->first())
                return \Response::json(['msg'=>'رقم الجوال موجود بالفعل'],404);

            if(User::where('email', $parameters['email'])->first())
                return \Response::json(['msg'=>'البريد الألكتروني موجود بالفعل'],404);

            $token = $this->generateTeamWorkToken($parameters);
            $parameters['token'] = $token["token"];

            $parameters['type'] = UserType::TEAM_WORK;
            $parameters['password'] = bcrypt($parameters['password']);
            $parameters['company_id'] = Auth::user()->id;
            $teamWork = new User();
            $teamWork->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    public function generateTeamWorkToken($data) {
        $encrypted = base64_encode(sha1($data['name'] . $data['phone'] . time(), true));
        $encrypted = str_replace("/","",$encrypted);
        $hash = array("token" => $encrypted);
        return $hash;
    }

    public function changePassword($team, $parameters)
    {
        $team->password = bcrypt($parameters['password']);
        $team->save();
        return response(array('msg' => 'Password updated'), 200);
    }

    /**
     * Get TeamWork.
     * @param $teamWorkId
     * @return TeamWork
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getTeamWork($teamWorkId)
    {
        try {
            $teamWork = User::findOrFail($teamWorkId);
            return $teamWork;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'TeamWork not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $teamWorkname
     * @return TeamWork
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateTeamWork($parameters, $teamWorkId)
    {
        try {
            $teamWork = User::findOrFail($teamWorkId);

            if(User::where('name', $parameters['name'])->where('id', '!=', $teamWorkId)->first())
                return \Response::json(['msg'=>'أسم الشركه موجود بالفعل'],404);

            if(User::where('phone', $parameters['phone'])->where('id', '!=', $teamWorkId)->first())
                return \Response::json(['msg'=>'رقم الجوال موجود بالفعل'],404);

            if(User::where('email', $parameters['email'])->where('id', '!=', $teamWorkId)->first())
                return \Response::json(['msg'=>'البريد الألكتروني موجود بالفعل'],404);

            $teamWork->update($parameters);
            return \Response::json(['msg'=>'تم التحديث بنجاح'],200);
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
    public function deleteTeamWork($teamWorkId)
    {
        return User::find($teamWorkId)->delete();
    }

}
