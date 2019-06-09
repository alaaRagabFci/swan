<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Hour;

class HourService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listHours()
    {
        return Hour::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($hours)
    {
        $tableData = Datatables::of($hours)
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','hours')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions'])->make(true);

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
    public function createHour($parameters)
    {
        try {
            if(Hour::where('hour', $parameters['hour'])->first())
                return \Response::json(['msg'=>'هذا الوقت موجود بالفعل'],404);

            $hour = new Hour();
            $hour->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Get Hours.
     * @param $hourId
     * @return Hours
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getHour($hourId)
    {
        try {
            $hour = Hour::findOrFail($hourId);
            return $hour;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Hours not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $hourname
     * @return Hours
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateHour($parameters, $hourId)
    {
        try {
            if(Hour::where('type', $parameters['type'])->where('id', '!=', $hourId)->first())
                return \Response::json(['msg'=>'هذا الوقت موجود بالفعل'],404);

            $hour = Hour::findOrFail($hourId);
            $hour->update($parameters);
            return \Response::json(['msg'=>'تم تحديث النوع بنجاح'],200);
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
    public function deleteHour($hourId)
    {
        return Hour::find($hourId)->delete();
    }
}
