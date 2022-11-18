<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionReuest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use DB;
use DataTables;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Region::select('id', 'region')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="region/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="region/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/region/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('region.index');
    }
    public function show(Region $region)
    {
        return view('region.show', [
            'region' => $region
        ]);
    }

    public function edit(Region $region)
    {
        return view('region.edit', [
            'region' => $region
        ]);
    }
    public function update(Region $region, UpdateRegionRequest $request)
    {
        $region->update($request->validated());
        return redirect()->route('region.index')
            ->withSuccess(__('Region updated successfully.'));
    }

    public function create()
    {
        return view('region.create');
    }

    public function store(StoreRegionReuest $request)
    {
        DB::beginTransaction();
        try {
            $region = new Region();
            $region->region = $request->region;
            $save = $region->save();
            if ($save) {
                DB::commit();
                return redirect()->route('region.index')
                    ->withSuccess(__('Region added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('region.index');
        // ->withSuccess(__('Payer code deleted successfully.'));
    }
}
