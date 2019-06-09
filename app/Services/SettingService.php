<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Setting;

class SettingService
{
    /**
     * List all Setting.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listSettings()
    {
        return Setting::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($settings)
    {
        $tableData = Datatables::of($settings)
            ->addColumn('actions', function ($data)
            {
                return view('settings.actionBtns')->with('controller','settings')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions'])->make(true);

        return $tableData ;
    }

    /**
     * Get client.
     * @param $settingId
     * @return Setting
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getSetting($settingId)
    {
        try {
            $setting = Setting::findOrFail($settingId);
            return $setting;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Setting not found');
        }
    }

    /**
     * Update client.
     * @param $settingId
     * @param $title_ar
     * @param $title_en
     * @param $description_ar
     * @param $description_en
     * @param $icon
     * @param $page
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateSetting($parameters, $settingId)
    {
        try {
            $setting = Setting::findOrFail($settingId);
            $setting->update($parameters);
            return response(array('msg' => 'Entity updated'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity not found'), 404);
        }
    }
}
