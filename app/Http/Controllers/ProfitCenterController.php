<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfitCenter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Http\Requests\UpdateProfitCodeRequest;
use App\Http\Requests\StoreProfitCodeRequest;
use App\Models\BusinessUnit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfitCenterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProfitCenter::select('id', 'profit_center','business_unit_id')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="profit_center/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="profit_center/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/profit_center/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->addColumn('business_unit_id', function($data){
                    $busineesUnit = BusinessUnit::find($data->business_unit_id);
                    return $busineesUnit->bu_name;
                })
        
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('profit_center.index');
    }
    public function show(ProfitCenter $profit_center)
    {
        $data = DB::table('profit_centers')
        ->select('profit_centers.id','profit_centers.profit_center','business_units.bu_name')
        ->join('business_units','business_units.id','=','profit_centers.business_unit_id')
        ->where('profit_centers.id',$profit_center->id)
        ->first();
        return view('profit_center.show', [
            'profit_center' => $data
        ]);
    }
    public function edit(ProfitCenter $profit_center)
    {
        return view('profit_center.edit', [
            'profit_center' => $profit_center,
            'businessUnit' => BusinessUnit::all('id','bu_name')
        ]);
    }
    public function update(ProfitCenter $profit_center, UpdateProfitCodeRequest $request)
    {
        $profit_center->update($request->validated());
        ProfitCenter::where('id', $profit_center->id)
       ->update([
           'profit_center' => $request->profit_center,
           'business_unit_id' => $request->bu_name,
           'updated_at' => Carbon::now(),
           'updated_by' => Auth::user()->id
           
        ]);
        return redirect()->route('profit_center.index')
            ->withSuccess(__('Profit Center updated successfully.'));
    }
    public function create()
    {
        $businessUnit = BusinessUnit::all('id','bu_name');
        return view('profit_center.create',compact('businessUnit'));
    }
    public function store(StoreProfitCodeRequest $request)
    {
        DB::beginTransaction();
        try {
            $profit_center = new ProfitCenter();
            $profit_center->profit_center = $request->profit_center;
            $profit_center->business_unit_id = $request->bu_name;
            $profit_center->created_at = Carbon::now();
            $profit_center->created_by = Auth::user()->id;
            $save = $profit_center->save();
            if ($save) {
                DB::commit();
                return redirect()->route('profit_center.index')
                    ->withSuccess(__('Profit Code added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(ProfitCenter $profit_center)
    {
        $profit_center->delete();
        return redirect()->route('profit_center.index');
            // ->withSuccess(__('Profit code deleted successfully.'));
    }
}
