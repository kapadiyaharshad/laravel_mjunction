<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateatCategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Category::select('id', 'category_name')->orderByDesc('id')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="category/' . $row->id . '/show"  class="btn btn-info btn-sm">Show</a> ';
                    $btn .= '<a href="category/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<button class="btn-delete btn-danger btn-sm" data-remote="/category/' . $row->id . '/delete">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('category.index');
    }
    public function show(Category $category)
    {
        return view('category.show', [
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }
    public function update(Category $category, UpdateatCategoryRequest $request)
    {
        $category->update($request->validated());
        return redirect()->route('category.index')
            ->withSuccess(__('Category updated successfully.'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->created_at = Carbon::now();
            $category->created_by = Auth::user()->id;
            $save = $category->save();
            if ($save) {
                DB::commit();
                return redirect()->route('category.index')
                    ->withSuccess(__('Category added successfully.'));
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect('insert')->with('failed', "operation failed");
        }
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
            // ->withSuccess(__('Payer code deleted successfully.'));
    }
}
