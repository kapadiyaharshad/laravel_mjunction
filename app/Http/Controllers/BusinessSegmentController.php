<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\BusinessSegment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBusinessSegmentReuest;
use App\Http\Requests\UpdateEcncRequest;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class BusinessSegmentController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = BusinessSegment::select('id', 'name')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="business_segment/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="business_segment/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/business_segment/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('business_segment.index');
    }

    public function show(BusinessSegment $business_segment)
    {
        return view('business_segment.show', [
            'business_segment' => $business_segment
        ]);
    }
    public function edit(BusinessSegment $business_segment)
    {
        return view('business_segment.edit', [
            'business_segment' => $business_segment
        ]);
    }
    public function update(BusinessSegment $business_segment, UpdateEcncRequest $request)
    {
        $business_segment->update($request->validated());
        return redirect()->route('business_segment.index')
            ->withSuccess(__('Business Segment updated successfully.'));
    }

    public function create()
    {
        return view('business_segment.create');
    }

    public function store(StoreBusinessSegmentReuest $request)
    {
        DB::beginTransaction();
        try {
            $businessSegment = new BusinessSegment();
            $businessSegment->name = $request->name;
            $businessSegment->created_at = Carbon::now();
            $businessSegment->created_by = Auth::user()->id;
            $save = $businessSegment->save();
            if ($save) {
                DB::commit();
                return redirect()->route('business_segment.index')
                    ->withSuccess(__('Business Segment added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(BusinessSegment $business_segment)
    {
        $business_segment->delete();
        return redirect()->route('business_segment.index');
            // ->withSuccess(__('Payer code deleted successfully.'));
    }
}
