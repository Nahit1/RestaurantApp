<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\Exports\SaleReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(){
        return view('report.index');
    }

    public function show(Request $request){

        $request->validate([
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);

        $dateStart = date('Y-m-d 00:00:00', strtotime($request->dateStart));
        $dateEnd = date('Y-m-d 23:59:59', strtotime($request->dateEnd));
        //dd($dateStart,$dateEnd);
        $sales = Sale::whereBetween('updated_at', [$dateStart, $dateEnd])->where('sale_status', 'paid');

        return view('report.showReport')->with('dateStart', date("m/d/y H:i:s", strtotime($request->dateStart)))
        ->with('dateEnd',date("m/d/y H:i:s", strtotime($request->dateEnd)))->with('totalSale', $sales->sum('total_price'))
        ->with('sales', $sales->paginate(5));
    }

    public function export(Request $request){
        return Excel::download(new SaleReportExport($request->dateStart, $request->dateEnd),'saleReport.xlsx');
    }

    
}
