<?php

namespace App\Http\Controllers;

use App\Exports\ExportClient;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Imports\ImportClient;
use App\Models\AccountType;
use App\Models\BusinessUnit;
use App\Models\Category;
use App\Models\Client;
use App\Models\BusinessSegment;
use App\Models\PayerCode;
use App\Models\ProfitCenter;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::select('id', 'client_name', 'email', 'contact', 'mobile', 'account_type_id', 'profit_center_id', 'category_id', 'business_segment_id', 'service_id')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="client/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="client/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/client/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addColumn('account_type_id', function($data){
                    $accountType = AccountType::find($data->account_type_id);
                    return $accountType->name;
                })
                ->addColumn('profit_center_id', function($data){
                    $profitCenter = ProfitCenter::find($data->profit_center_id);
                    return $profitCenter->profit_center;
                })
                ->addColumn('category_id', function($data){
                    $category = Category::find($data->category_id);
                    return $category->category_name;
                })
                ->addColumn('business_segment_id', function($data){
                    $businessSegment = BusinessSegment::find($data->business_segment_id);
                    return $businessSegment->name;
                })
                ->addColumn('service_id', function($data){
                    $service = Service::find($data->service_id);
                    return $service->service_name;
                })
                ->make(true);
        }
        return view('client.index');
    }
    public function show(Client $client)
    {
        return view('client.show', [
            'client' => $client
        ]);
    }

    public function edit(Client $client)
    {
        // $like = 'AM-' . $client->account_type;
        // $account_manager = User::select('name')->where('accounttype', 'like', '%' . $like . '%')->where('role', 'AM')->get();
        // $bu = Bu::all();
        // $services = Service::all();
        // $category = Category::all();
        // $business_segment = BusinessUnit::all();
        // $profit_center = ProfitCenter::all();
        // $payer_code = PayerCode::all();
        // $account_type = AccountType::all();
        // return view('client.edit', [
            // 'client' => $client,
            // 'bu' => $bu,
            // 'services' => $services,
            // 'category' => $category,
            // 'business_segment' => $business_segment,
            // 'profit_center' => $profit_center,
            // 'payer_code' => $payer_code,
            // 'account_type' => $account_type,
            // 'account_manager' => $account_manager
        // ]);
        $businessUnit = BusinessUnit::all();
        $services = Service::all();
        $category = Category::all();
        $businessSegment = BusinessSegment::all();
        $profitCenter = ProfitCenter::all();
        $payeCode = PayerCode::all();
        $accountType = AccountType::all();
        return view('client.edit', [
            'client' => $client,
            'businessUnit' => $businessUnit,
            'services' => $services,
            'category' => $category,
            'business_segment' => $businessSegment,
            'profit_center' => $profitCenter,
            'payer_code' => $payeCode,
            'account_type' => $accountType
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'clientname' => 'required|unique:clients,clientname,' . $request->id,
            'business_unit' => 'required',
            'services' => 'required',
            'category' => 'required',
            'business_segment' => 'required',
            'profit_center' => 'required',
            'payercode' => 'required',
            'account_type' => 'required'
        ]);

        $updateArray = [
            'clientname' => $request->clientname,
            'email' => $request->email,
            'mobilenum' => $request->mobilenum,
            'business_unit' => $request->business_unit,
            'services' => $request->services,
            'category' => $request->category,
            'business_segment' => $request->business_segment,
            'profit_center' => $request->profit_center,
            'payercode' => $request->payercode,
            'account_type' => $request->account_type,
            'account_manager' => $request->account_manager,
            'status' => $request->status
        ];
        $update = Client::where('id', $request->id)
            ->update($updateArray);
        if ($update) {
            return redirect()->route('client.index')
                ->withSuccess(__('Client updated successfully.'));
        }
    }

    public function create()
    {
        $businessUnit = BusinessUnit::all();
        $services = Service::all();
        $category = Category::all();
        $businessSegment = BusinessSegment::all();
        $profitCenter = ProfitCenter::all();
        $payeCode = PayerCode::all();
        $accountType = AccountType::all();
        return view('client.create', [
            'businessUnit' => $businessUnit,
            'services' => $services,
            'category' => $category,
            'business_segment' => $businessSegment,
            'profit_center' => $profitCenter,
            'payer_code' => $payeCode,
            'account_type' => $accountType
        ]);
    }

    public function store(StoreClientRequest $request)
    {
        DB::beginTransaction();
        try {
            $client = new Client();
            $client->client_name = $request->client_name;
            $client->contact = $request->contact;
            $client->client_code = $request->client_code;
            $client->email = $request->email;
            $client->mobile = $request->mobilenum;
            $client->business_unit_id = $request->bu_name;
            $client->service_id = $request->service_name;
            $client->category_id = $request->category_name;
            $client->business_segment_id = $request->business_segment;
            $client->profit_center_id = $request->profit_center;
            // $client->payercode = $request->payer_code;
            $client->account_type_id = $request->account_type;
            $client->status = $request->status;
            $client->user_id = Auth::user()->id;
            $client->created_at = Carbon::now();
            $client->created_by = Auth::user()->id;
            $save = $client->save();
            if ($save) {
                DB::commit();
                return redirect()->route('client.index')
                    ->withSuccess(__('Client added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index');
        // ->withSuccess(__('Payer code deleted successfully.'));
    }
    public function get_account_manager(Request $request)
    {
        $like = 'AM-' . $request->account_type;
        $account_manager = User::select('name')->where('accounttype', 'like', '%' . $like . '%')->where('role', 'AM')->get();
        return response()->json($account_manager);
    }

    public function export() 
    {
        return Excel::download(new ExportClient, 'clients.xlsx');
    }

    public function import() 
    {
        Excel::import(new ImportClient, request()->file('file'));
        return redirect()->route('client.index')
            ->withSuccess(__('Clients imported successfully.'));
    }
}
