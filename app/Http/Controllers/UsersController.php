<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use DataTables;
use Spatie\Permission\Models\Permission;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use App\Models\AccountType;
use App\Models\BusinessUnit;
use App\Models\Category;
use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'fname', 'email','role_id')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="users/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="users/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/users/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->addColumn('role_id', function($data) {
                   $roleName = DB::table('roles')->select('name')->where('id',$data->role_id)->first();
                    return $roleName->name;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users.index');
    }

    public function create()
    {
        $businessUnit = BusinessUnit::all('id', 'bu_name');
        $accountType = AccountType::all('id', 'name');
        $roles = DB::table('roles')->get();
        $designation = Designation::all('id','name');
        $category = Category::all('id','category');
        return view('users.create', compact('roles', 'businessUnit', 'accountType','designation','category'));
    }

    // public function store(User $user, StoreUserRequest $request)
    // {
        
    //     $user->create($request->validated());
    //     return redirect()->route('users.index')
    //         ->withSuccess(__('User created successfully.'));
    // }

    public function store(User $user,StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            // if ($request->business_user != null) {
            //     $len = count($request->business_user);
            //     $arr_bu = [];
            //     $arr_ac = [];
            //     for ($i = 0; $i < $len; $i++) {
            //         array_push($arr_ac, $request->role . '-' . $request->business_user[$i]);
            //         array_push($arr_bu, $request->business_user[$i]);
            //     }
            //     $accountType = join(', ', $arr_ac);
            //     $business_user = join(', ', $arr_bu);
            // }
            // if ($request->account_type != null) {
            //     $len = count($request->account_type);
            //     $arr = [];
            //     for ($i = 0; $i < $len; $i++) {
            //         array_push($arr, $request->role . '-' . $request->account_type[$i]);
            //     }
            //     $accountType = join(', ', $arr);
            //     $business_user = '';
            // }
            
            $userData = new User();
            $userData->fname = $request->fname;
            $userData->lname = $request->lname;
            $userData->email = $request->email;
            $userData->contact = $request->contact;
            $userData->role_id = $request->role_id;
            // $userData->account_type = $request->account_type;
            $userData->designation_id = $request->designation_id;
            $userData->business_unit_id = $request->business_unit_id;
            $userData->account_type_id = $request->account_type_id;
            $userData->category_id = $request->category_id;
            $userData->status = $request->status;
            $userData->import_type = 1;
            $userData->created_at = Carbon::now();
            $userData->created_by = Auth::user()->id;

            $save = $userData->save();
            if ($save) {
                DB::commit();
                return redirect()->route('users.index')
                    ->withSuccess(__('User created successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function show(User $user)
    {
        $userData = DB::table('users')
        ->select('users.id','users.fname','users.lname','users.email','users.contact','users.status','roles.name as roleName','designations.name as designationName','business_units.bu_name','account_types.name','categories.category')
        ->join('roles','roles.id','=','users.role_id')
        ->join('designations','designations.id','=','users.designation_id')
        ->join('business_units','business_units.id','=','users.business_unit_id')
        ->join('account_types','account_types.id','=','users.account_type_id')
        ->join('categories','categories.id','=','users.category_id')
        // ->where(['users.id' => $user->id])
        ->first();
        return view('users.show', [
            'userData' => $userData
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $businessUnit = Bu::all('id', 'bu');
        $accountType = AccountType::all('id', 'account_type');
        $designation = Designation::all('id','name');
        $category = Category::all('id','category');
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'businessUnit' => $businessUnit,
            'accountType' => $accountType,
            'designation' => $designation,
            'category' => $category,
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());
        User::where('id', $user->id)
       ->update([
           'fname' => $request->fname,
           'lname' => $request->lname,
           'email' => $request->email,
           'contact' => $request->contact,
           'role_id' => $request->role_id,
           'designation_id' => $request->designation_id,
           'business_unit_id' => $request->business_unit_id,
           'account_type_id' => $request->account_type_id,
           'category_id' => $request->category_id,
           'status' => $request->status
        ]);
        $user->syncRoles($request->get('role_id'));
        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
            // ->withSuccess(__('User deleted successfully.'));
    }

    public function export() 
    {
        return Excel::download(new ExportUsers, 'users.xlsx');
    }

    public function import() 
    {
        Excel::import(new ImportUsers, request()->file('file'));
        return redirect()->route('users.index')
            ->withSuccess(__('User imported successfully.'));
    }
}
