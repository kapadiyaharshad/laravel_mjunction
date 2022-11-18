<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceReuest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Service::select('id', 'service_name')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="service/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="service/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/service/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('service.index');
    }
    public function show(Service $service)
    {
        return view('service.show', [
            'service' => $service
        ]);
    }
    public function edit(Service $service)
    {
        return view('service.edit', [
            'service' => $service
        ]);
    }
    public function update(Service $service, UpdateServiceRequest $request)
    {
        $service->update($request->validated());
        return redirect()->route('service.index')
            ->withSuccess(__('Service updated successfully.'));
    }
    public function create()
    {
        return view('service.create');
    }
    public function store(StoreServiceReuest $request)
    {
        DB::beginTransaction();
        try {
            $services = new Service();
            $services->service_name = $request->service_name;
            $services->created_at = Carbon::now();
            $services->created_by = Auth::user()->id;
            $save = $services->save();
            if ($save) {
                DB::commit();
                return redirect()->route('service.index')
                    ->withSuccess(__('Service added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(Service $Service)
    {
        $Service->delete();
        return redirect()->route('Service.index');
            // ->withSuccess(__('Payer code deleted successfully.'));
    }
}
