<?php
namespace App\Http\Controllers;

use App\Billing;
use App\Customer;
use App\Employee;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use mysql_xdevapi\Collection;

class PDFController extends Controller
{
    public function pdfDownload()
    {

        $id = Input::get('id');

        $bill = Billing::with('customer')->where('id', $id)->first();

        $pdf = PDF::loadView('admin.invoice.invoice2', ['bill' => $bill])->setPaper('a4', 'landscape');

       // $pdf = PDF::loadView('admin.invoice.invoice3')->setPaper('a4', 'landscape');

        return $pdf->download('invoice.pdf');

    }

    public function basic() 
    {
         return view('admin.dashboard.basic');
    }

    public function ecommerce() 
    {
        return view('admin.dashboard.ecommerce');
    }

    public function finance() 
    {
        return view('admin.dashboard.finance');
    }
}
