<?php

namespace App\Services;
use App\Constants\UserType;
use App\Models\UserDevice;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Helpers\PushNotification;

class UserService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listCompanies()
    {
        return User::where('type' , UserType::COMPANY)->get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($companies)
    {
        $tableData = Datatables::of($companies)
            ->addColumn('is_active', function (User $user){
                if($user->is_active)
                    return '<span class="label label-sm label-primary"> مفعل </span>';
                else
                    return '<span class="label label-sm label-warning"> غير مفعل </span>';
            })
            ->addColumn('is_blocked', function (User $user){
                if($user->is_blocked)
                    return '<span class="label label-sm label-warning"> محظور </span>';
                else
                    return '<span class="label label-sm label-primary"> غير محظور </span>';
            })
            ->addColumn('category', function (User $user){
                if($user->getCategory)
                    return $user->getCategory->name;
            })
            ->addColumn('region', function (User $user){
                if($user->getRegion)
                    return $user->getRegion->name;
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','companies')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'is_blocked', 'is_active', 'category', 'region'])->make(true);

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
    public function createCompany($parameters)
    {
        try {
            if(User::where('name', $parameters['name'])->first())
                return \Response::json(['msg'=>'أسم الشركه موجود بالفعل'],404);

            if(User::where('phone', $parameters['phone'])->first())
                return \Response::json(['msg'=>'رقم الجوال موجود بالفعل'],404);

            if(User::where('email', $parameters['email'])->first())
                return \Response::json(['msg'=>'البريد الألكتروني موجود بالفعل'],404);

            $token = $this->generateCompanyToken($parameters);
            $parameters['token'] = $token["token"];

            $parameters['password'] = bcrypt($parameters['password']);
            $parameters['type'] = UserType::COMPANY;
            $user = new User();
            $user->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    public function generateCompanyToken($data) {
        $encrypted = base64_encode(sha1($data['name'] . $data['phone'] . time(), true));
        $encrypted = str_replace("/","",$encrypted);
        $hash = array("token" => $encrypted);
        return $hash;
    }

    public function changePassword($company, $parameters)
    {
        $company->password = bcrypt($parameters['password']);
        $company->save();
        return response(array('msg' => 'Password updated'), 200);
    }

    /**
     * Get Company.
     * @param $userId
     * @return Company
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getCompany($userId)
    {
        try {
            $user = User::findOrFail($userId);
            return $user;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Company not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $username
     * @return Company
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateCompany($parameters, $userId)
    {
        try {
            $user = User::findOrFail($userId);

            if(User::where('name', $parameters['name'])->where('id', '!=', $userId)->first())
                return \Response::json(['msg'=>'أسم الشركه موجود بالفعل'],404);

            if(User::where('phone', $parameters['phone'])->where('id', '!=', $userId)->first())
                return \Response::json(['msg'=>'رقم الجوال موجود بالفعل'],404);

            $user->update($parameters);
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
    public function deleteCompany($userId)
    {
        return User::find($userId)->delete();
    }

    /**
     * Get admin info.
     * @param $userId
     * @return Company
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getAdmin($userId)
    {
        try {
            $user = User::findOrFail($userId);
            return $user;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Company not found');
        }
    }

}
