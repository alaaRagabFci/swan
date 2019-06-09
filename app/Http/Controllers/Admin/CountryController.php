<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\CountryService;
use Response;

class CountryController extends AbstractController {

    public $countryService;
    public function __construct(CountryService $countryService)
    {
        $this->middleware('auth');
        $this->countryService = $countryService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $countries  = $this->countryService->listCountries();
        $tableData = $this->countryService->datatables($countries);

        if($request->ajax())
            return $tableData;

        return view('countries.index')
              ->with('modal', 'countries')
              ->with('tableData', $tableData);
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
        $country = $this->countryService->getCountry($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $country->toJson()]);
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
        $country = $this->countryService->updateCountry($data, $id);

        return $country;
    }
}
