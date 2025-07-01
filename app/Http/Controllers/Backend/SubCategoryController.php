<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use function Termwind\render;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'category_id' => ['required'],
                'name' => ['required', 'max:200', 'unique:sub_categories,name'],
                'status' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $subCategory = new SubCategory();

        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();

        notify()->success('Sub Category Information Created Successfully!');

        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::findOrFail($id);
        return view('admin.sub-category.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'category_id' => ['required'],
                'name' => ['required', 'max:200', 'unique:sub_categories,name,' . $id],
                'status' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $subCategory = SubCategory::findOrFail($id);

        $hasChanges = false;

        if (
            $subCategory->category_id !== $request->category_id ||
            $subCategory->name !== $request->name ||
            $subCategory->status !== $request->status
        ) {
            $hasChanges = true;
            $subCategory->category_id = $request->category_id;
            $subCategory->name = $request->name;
            $subCategory->slug = Str::slug($request->name);
            $subCategory->status = $request->status;
        }

        Cache::forget('sub-categories');

        if ($hasChanges) {
            $subCategory->save();
            notify()->success('Sub Category Information Changed Successfully!');
            return redirect()->route('admin.sub-category.index');
        } else {
            notify()->info('No changes were made.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::with('childCategories')->findOrFail($id);

        if ($subCategory->childCategories->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please delete child-categories before deleting this sub-category.'
            ], 400);
        }

        $subCategory->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Sub-category deleted successfully.'
        ]);
    }

    public function changeStatus(Request $request)
    {
        $subCategory = SubCategory::findOrFail($request->id);
        $subCategory->status = $request->status == 'true' ? 1 : 0;
        $subCategory->save();

        // return notify()->success('Category Status Changed Successfully!');
        return response()->json(['message' => 'Sub Category Status Changed Successfully!']);
    }
}
