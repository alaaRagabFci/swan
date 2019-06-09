<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Models\Email;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables as Datatables;

class ContactController extends AbstractController {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $emails  = Email::get();
        $tableData = Datatables::of($emails)->make(true);

        if($request->ajax())
            return $tableData;

        return view('contacts.index')
              ->with('modal', 'contacts')
              ->with('tableData', $tableData);
    }
}
