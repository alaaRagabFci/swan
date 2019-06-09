<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\AirType;

class AirTypeService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listAirTypes()
    {
        return AirType::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($airTypes)
    {
        $tableData = Datatables::of($airTypes)
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','air-types')
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
    public function createAirType($parameters)
    {
        try {
            if(AirType::where('type', $parameters['type'])->first())
                return \Response::json(['msg'=>'هذا النوع موجود بالفعل'],404);

            $airType = new AirType();
            $airType->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Get AirTypes.
     * @param $airTypeId
     * @return AirTypes
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getAirType($airTypeId)
    {
        try {
            $airType = AirType::findOrFail($airTypeId);
            return $airType;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'AirTypes not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $airTypename
     * @return AirTypes
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateAirType($parameters, $airTypeId)
    {
        try {
            if(AirType::where('type', $parameters['type'])->where('id', '!=', $airTypeId)->first())
                return \Response::json(['msg'=>'هذا الحي موجود بالفعل'],404);

            $airType = AirType::findOrFail($airTypeId);
            $airType->update($parameters);
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
    public function deleteAirType($airTypeId)
    {
        return AirType::find($airTypeId)->delete();
    }
}
