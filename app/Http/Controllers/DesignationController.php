<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Designation::select('id','name', 'description')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="designation/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="designation/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/designation/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('designation.index');
    }

    public function show(Designation $designation)
    {
        return view('designation.show', [
            'designation' => $designation
        ]);
    }
    public function edit(Designation $designation)
    {
        return view('designation.edit', [
            'designation' => $designation
        ]);
    }
    public function update(Designation $designation, UpdateDesignationRequest $request)
    {
        $designation->update($request->validated());
        return redirect()->route('designation.index')
            ->withSuccess(__('Designation updated successfully.'));
    }
    public function create()
    {
        return view('designation.create');
    }
    public function store(StoreDesignationRequest $request)
    {
        DB::beginTransaction();
        try {
            $designation = new Designation();
            $designation->name = $request->name;
            $designation->description = $request->description;
            $designation->created_at = Carbon::now();
            $designation->created_by = Auth::user()->id;
            $save = $designation->save();
            if ($save) {
                DB::commit();
                return redirect()->route('designation.index')
                    ->withSuccess(__('Designation added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('bu.index');
            // ->withSuccess(__('Payer code deleted successfully.'));
    }
   
}
