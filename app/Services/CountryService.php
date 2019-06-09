<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Country;

class CountryService
{
    /**
     * List all Country.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listCountries()
    {
        return Country::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($countries)
    {
        $tableData = Datatables::of($countries)
            ->addColumn('actions', function ($data)
            {
                return view('countries.actionBtns')->with('controller','countries')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions'])->make(true);

        return $tableData ;
    }

    /**
     * Get client.
     * @param $countryId
     * @return Country
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getCountry($countryId)
    {
        try {
            $country = Country::findOrFail($countryId);
            return $country;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Country not found');
        }
    }

    /**
     * Update client.
     * @param $countryId
     * @param $title_ar
     * @param $title_en
     * @param $description_ar
     * @param $description_en
     * @param $icon
     * @param $page
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateCountry($parameters, $countryId)
    {
        try {
            $country = Country::findOrFail($countryId);
            $country->update($parameters);
            return response(array('msg' => 'Entity updated'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity not found'), 404);
        }
    }
}
