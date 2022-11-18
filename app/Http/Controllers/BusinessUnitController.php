<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Http\Requests\UpdateBuRequest;
use App\Http\Requests\StoreBusinessUnitsReuest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BusinessUnitController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = BusinessUnit::select('id', 'bu_name')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="business_unit/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="business_unit/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/business_unit/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('business_unit.index');
    }

    public function show(BusinessUnit $businessUnit)
    {
        return view('business_unit.show', [
            'business_unit' => $businessUnit
        ]);
    }
    public function edit(BusinessUnit $businessUnit)
    {
        return view('business_unit.edit', [
            'business_unit' => $businessUnit
        ]);
    }
    public function update(BusinessUnit $businessUnit, UpdateBuRequest $request)
    {
        $businessUnit->update($request->validated());
        return redirect()->route('business_unit.index')
            ->withSuccess(__('Business unit updated successfully.'));
    }
    public function create()
    {
        return view('business_unit.create');
    }
    public function store(StoreBusinessUnitsReuest $request)
    {   
        DB::beginTransaction();
        try {
            $business_unit = new BusinessUnit();
            $business_unit->bu_name = $request->bu_name;
            $business_unit->created_at = Carbon::now();
            $business_unit->created_by = Auth::user()->id;
            $save = $business_unit->save();
            if ($save) {
                DB::commit();
                return redirect()->route('business_unit.index')
                    ->withSuccess(__('Business unit added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(BusinessUnit $businessUnit)
    {
        $businessUnit->delete();
        return redirect()->route('business_unit.index');
            // ->withSuccess(__('Payer code deleted successfully.'));
    }
   
}
