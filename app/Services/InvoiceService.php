<?php

namespace App\Services;
use App\Constants\UserType;
use App\Models\Application;
use App\Models\Category;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\VarDumper\VarDumper;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Invoice;
use App\Constants\InvoiceStatus;
use Auth;

class InvoiceService
{
    public function listInvoices()
    {
        return Invoice::get();
    }

    public function datatables($invoices)
    {
        $tableData = Datatables::of($invoices)
            ->addColumn('application', function (Invoice $invoice){
                return $invoice->getApplication->id;
            })
            ->addColumn('company', function (Invoice $invoice){
                return $invoice->getApplication->getCompany->name;
            })
            ->addColumn('status', function (Invoice $invoice) {
                if ($invoice->status == InvoiceStatus::PAID)
                    return '<span class="label label-sm label-success"> مدفوعة </span>';
                else
                    return '<span class="label label-sm label-warning"> غير مدفوعة </span>';

            })
            ->addColumn('actions', function ($data)
            {
                return view('invoices.actionBtns')->with('controller','invoices')
                    ->with('id', $data->id)
                    ->render();
            })
            ->rawColumns(['application', 'status', 'company', 'actions'])->make(true);

        return $tableData ;
    }

    public function addInvoice($parameters, $orderId)
    {
        $company = User::find(Auth::user()->id);

        if(Auth::user()->type == UserType::COMPANY){
            $export = UserType::COMPANY;
            $category = Category::find($company->category_id);
        }

        if(Auth::user()->type == UserType::TEAM_WORK){
            $export = UserType::TEAM_WORK;
            $getCompany = User::find($company->company_id);
            $category = Category::find($getCompany->category_id);
        }

        $order = Application::find($orderId);
        if($parameters['amount'] > $category->x)
            $commission = $parameters['amount'] * ($category->commission_more / 100);
        if($parameters['amount'] < $category->x)
            $commission = $parameters['amount'] * ($category->commission_less / 100);
        if($parameters['amount'] == $category->x)
            $commission = $parameters['amount'] * ($category->commission_less / 100);

        $invoice = new Invoice();
        $invoice->application_id = $orderId;
        $invoice->amount = $parameters['amount'];
        $invoice->invoice_number = '#'.$orderId .'-'. date('Y');
        $invoice->export = $export;
        $invoice->export_id = Auth::user()->id;
        $invoice->commission = $commission;
        $invoice->save();
        return $invoice;

    }

    /**
     * Get Regions.
     * @param $regionId
     * @return Regions
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getInvoice($invoiceId)
    {
        try {
            $invoice = Invoice::findOrFail($invoiceId);
            return $invoice;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'invoice not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $regionname
     * @return Regions
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateInvoice($parameters, $invoiceId)
    {
        try {
            $invoice = Invoice::findOrFail($invoiceId);
            $invoice->update($parameters);
            return \Response::json(['msg'=>'تم تغير حالة الفاتورة بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

}
