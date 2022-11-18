<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayerCode;
use DataTables;
use App\Http\Requests\UpdatePayerCodeRequest;
use App\Http\Requests\StorePayerCodeRequest;
use App\Models\Client;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class PayerCodeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PayerCode::select('id', 'payer_code','client_id')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="payer_code/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="payer_code/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/payer_code/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->addColumn('client_id', function($data){
                    $client = Client::find($data->client_id);
                    return $client->client_name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('payer_code.index');
    }
    public function show(PayerCode $payer_code)
    {
        $payer_code = DB::table('payer_codes')
        ->select('payer_codes.id','payer_codes.payer_code','clients.client_name')
        ->join('clients','clients.id','=','payer_codes.client_id')
        ->where('payer_codes.id',$payer_code->id)
        ->first();
        return view('payer_code.show', [
            'payer_code' => $payer_code
        ]);
    }
    public function edit(PayerCode $payer_code)
    {
        return view('payer_code.edit', [
            'payer_code' => $payer_code,
            'client' =>  Client::all('id','client_name')
        ]);
    }
    public function update(PayerCode $payer_code, UpdatePayerCodeRequest $request)
    {
        $payer_code->update($request->validated());
        PayerCode::where('id', $payer_code->id)
       ->update([
           'payer_code' => $request->payer_code,
           'client_id' => $request->client_name,
           'updated_at' => Carbon::now(),
           'updated_by' => Auth::user()->id
           
        ]);
        return redirect()->route('payer_code.index')
            ->withSuccess(__('Payer code updated successfully.'));
    }
    public function create()
    {
        $client = Client::all('id','client_name');
        return view('payer_code.create',compact('client'));
    }
    public function store(StorePayerCodeRequest $request)
    {
        DB::beginTransaction();
        try {
            $payer_code = new PayerCode();
            $payer_code->payer_code = $request->payer_code;
            $payer_code->client_id = $request->client_name;
            $payer_code->created_at = Carbon::now();
            $payer_code->created_by = Auth::user()->id;
            $save = $payer_code->save();
            if ($save) {
                DB::commit();
                return redirect()->route('payer_code.index')
                    ->withSuccess(__('Payer Code added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(PayerCode $payer_code)
    {
        $payer_code->delete();
        return redirect()->route('payer_code.index');
            // ->withSuccess(__('Payer code deleted successfully.'));
    }

}
