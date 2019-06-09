<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\InvoiceService;
use Response;

class InvoiceController extends AbstractController {

    public $invoiceService;
    public function __construct(InvoiceService $invoiceService)
    {
        $this->middleware('auth');
        $this->invoiceService = $invoiceService;
    }

    public function index(Request $request)
    {
        $invoices  = $this->invoiceService->listInvoices();
        $tableData = $this->invoiceService->datatables($invoices);

        if($request->ajax())
            return $tableData;

        return view('invoices.index')
              ->with('modal', 'invoices')
              ->with('modal_', 'الفواتير')
              ->with('tableData', $tableData);
    }

    public function addInvoice(Request $request, $id){
        $parameters = $request->all();
        $invoice = $this->invoiceService->addInvoice($parameters, $id);
        return $invoice;
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
        $invoice = $this->invoiceService->getInvoice($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $invoice->toJson()]);
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
        $invoice = $this->invoiceService->updateInvoice($data, $id);

        return $invoice;
    }
}
