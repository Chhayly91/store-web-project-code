<?php

namespace App\Http\Controllers;

use App\Invoice;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use PhpParser\Node\Expr\Array_;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $invoices = Invoice::all();

        $collection = array();
        foreach ($invoices as $invoice){
            $collection[] = $invoice->customer_name;
        }
        $uniques = array_unique($collection);
        return view('report.create')->with('uniques',$uniques);
    }

    public function filter(Request $request){
        $reports = Invoice::where('status', 1);

        if ($request->has('filter_customer_name')) {
            if ($request->filter_customer_name == 1){
                $reports->get();
            }else
            $reports->where('customer_name', $request->filter_customer_name);
        }

        if ($request->has('filter_payment')) {
            if ($request->filter_payment==null){
                $reports->get();
            }else
            $reports->where('payment_status', $request->filter_payment);
        }

        if ($request->has('filter_date_range')){
            if ($request->filter_date_range ==null){
                $reports->get();
            }else{
                $datefilters = explode('-', $request->filter_date_range);
                for ($i=0;$i<count($datefilters);$i++){
                    if ($i==0){
                        $from = date('Y-m-d'.' 00:00:00',strtotime($datefilters[$i]));
//                    dd($from);

                    }
                    if ($i==1){
                        $to = date('Y-m-d'.' 00:00:00',strtotime($datefilters[$i]));
//                    dd($to);
                    }
                }
                $reports->whereBetween('created_at',[$from,$to]);
            }



        }
        //$pdf = PDF::loadView('print.report_bill',['reports'=>$reports])->setPaper('a5');
        return response()->json($reports->get());
    }

    public function print_filter(Request $request){
        $reports = Invoice::where('status', 1);

        if ($request->has('filter_customer_name')) {
            if ($request->filter_customer_name == 1){
                $reports->get();
            }else
                $reports->where('customer_name', $request->filter_customer_name);
        }

        if ($request->has('filter_payment')) {
            if ($request->filter_payment==null){
                $reports->get();
            }else
                $reports->where('payment_status', $request->filter_payment);
        }

        if ($request->has('filter_date_range')){
            if ($request->filter_date_range ==null){
                $reports->get();
            }else{
                $datefilters = explode('-', $request->filter_date_range);
                for ($i=0;$i<count($datefilters);$i++){
                    if ($i==0){
                        $from = date('Y-m-d'.' 00:00:00',strtotime($datefilters[$i]));
//                    dd($from);

                    }
                    if ($i==1){
                        $to = date('Y-m-d'.' 00:00:00',strtotime($datefilters[$i]));
//                    dd($to);
                    }
                }
                $reports->whereBetween('created_at',[$from,$to]);
            }



        }
        //dd($reports->get());

        return view('print.report_bill')->with('reports',$reports->get());
        //$pdf = PDF::loadView('print.report_bill_Backup',['reports'=>$reports->get()])->setPaper('a4');
        //dd($reports->get());
        //return $pdf->stream('allreport.pdf');
    }


}
