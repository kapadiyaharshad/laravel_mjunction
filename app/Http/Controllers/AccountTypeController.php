<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Http\Requests\UpdateAccountTypeRequest;
use App\Http\Requests\StoreAccountTypeReuest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AccountTypeController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = AccountType::select('id', 'name','code')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="account_type/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="account_type/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/account_type/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('account_type.index');
    }
    public function show(AccountType $account_type)
    {
        return view('account_type.show', [
            'account_type' => $account_type
        ]);
    }

    public function edit(AccountType $account_type)
    {
        return view('account_type.edit', [
            'account_type' => $account_type
        ]);
    }
    public function update(AccountType $account_type, UpdateAccountTypeRequest $request)
    {
        $account_type->update($request->validated());
        AccountType::where('id', $account_type->id)
        ->update([
            'name' => $request->name,
            'code' => $request->code ? $request->code : '',
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::user()->id,
         ]);
        return redirect()->route('account_type.index')
            ->withSuccess(__('Account Type updated successfully.'));
    }

    public function create()
    {
        return view('account_type.create');
    }

    public function store(StoreAccountTypeReuest $request)
    {
        DB::beginTransaction();
        try {
            $accountType = new AccountType();
            $accountType->name = $request->name;
            $accountType->code = isset($request->code) ? $request->code : '';
            $accountType->created_at = Carbon::now();
            $accountType->created_by = Auth::user()->id;
            $save = $accountType->save();
            if ($save) {
                DB::commit();
                return redirect()->route('account_type.index')
                    ->withSuccess(__('Account Type added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(AccountType $account_type)
    {
        $account_type->delete();
        return redirect()->route('account_type.index');
            // ->withSuccess(__('Payer code deleted successfully.'));
    }
}
