<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use App\Imports\ContractUpdate;
use App\Imports\TownshipUpdate;
use App\Imports\PaymentImport;

use App\Exports\ReceiptExport;
use App\Exports\BillingExport;
use App\Exports\IncidentExport;
use App\Exports\RadiusExport;
use App\Exports\TempBillingExport;
use App\Exports\RevenueExport; 
use App\Exports\PublicIpExport; 
use App\Imports\CustomersUpdate;
use App\Imports\DNUpdate;
use App\Imports\SNUpdate;
use App\Imports\TempBillingUpdate;
use Excel;
use Storage;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class ExcelController extends Controller
{
    public function importExportView()
    {
       return view('excel.index');
    }
    public function paymentImportView()
    {
       return view('excel.payment');
    }
    public function tempImportView()
    {
       return view('excel.tempupdate');
    }
    public function updateContractView()
    {
       return view('excel.contractupdate');
    }
    public function updateTownshipView()
    {
       return view('excel.townshipupdate');
    }
    public function updateCustomerView()
    {
       return view('excel.customerupdate');
    }

    public function updateDNView()
    {
       return view('excel.dnupdate');
    }

    public function updateSNView()
    {
       return view('excel.snupdate');
    }
   
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportExcel(Request $request) 
    {
        //$type = xlsx, xls etc.
     //   return (new CustomersExport(($request)));
    // return (new CustomersExport($request))->download('customers.csv');
     return FacadesExcel::download(new CustomersExport($request), 'customers.xlsx', \Maatwebsite\Excel\Excel::XLSX);
       // return Excel::download(new CustomersExport($request), 'customers.csv');
    }
    public function exportBillingExcel(Request $request) 
    { 
     return (new BillingExport($request))->download('billings.csv');
    }
    public function exportTempBillingExcel(Request $request) 
    { 
     return (new TempBillingExport($request))->download('temp_billings.csv');
    }
    public function exportRevenue(Request $request) 
    { 
     return (new RevenueExport($request))->download('revenue.csv');
    }
    public function exportReceipt(Request $request) 
    { 
     return (new ReceiptExport($request))->download('receipts.csv');
    }
    public function exportIncidentReportExcel (Request $request) 
    { 
     return (new IncidentExport($request))->download('incidents.csv');
    }
    public function exportRadiusReportExcel (Request $request) 
    { 
     return (new RadiusExport($request))->download('radius_users.csv');
    }
    public function exportPublicIpReportExcel (Request $request) 
    { 
        return FacadesExcel::download(new PublicIpExport($request), 'publicIp.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExcel(Request $request) 
    {
        Excel::import(new CustomersImport,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
    public function updateExcel(Request $request) 
    {
        Storage::prepend('import_log.log', 'Importing Excel File');
        Excel::import(new CustomersUpdate,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
    public function updateContract(Request $request) 
    {
        Storage::prepend('contract_update.log', 'Importing Excel File');
        Excel::import(new ContractUpdate,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
    public function updateTownship(Request $request) 
    {
        ini_set('max_execution_time', 0);
        Storage::prepend('township_update.log', 'Importing Excel File');
        Excel::import(new TownshipUpdate,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
    public function updateCustomer(Request $request) 
    {
      //  Storage::prepend('import_log.log', 'Importing Excel File');
        Excel::import(new CustomersUpdate,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
    public function updateTemp(Request $request) 
    {
        Storage::prepend('import_log.log', 'Importing Excel File');
        Excel::import(new TempBillingUpdate,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
    public function importPayment(Request $request) 
    {
        Excel::import(new PaymentImport,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }

    public function importDN(Request $request) 
    {
        Excel::import(new DNUpdate,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
    public function importSN(Request $request) 
    {
        Excel::import(new SNUpdate,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
}