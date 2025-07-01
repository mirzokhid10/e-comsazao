<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:100'],
                'icon' => ['required', 'max:100'],
                'status' => ['required'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $category = new Category();

        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        $category->save();

        notify()->success('Category Information Created Successfully!');

        return redirect()->route('admin.category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:100'],
                'icon' => ['required', 'max:100'],
                'status' => ['required'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $category = Category::findOrFail($id);

        $hasChanges = false;

        if (
            $category->name !== $request->name ||
            $category->icon !== $request->icon ||
            $category->status !== $request->status
        ) {
            $hasChanges = true;
            $category->name = $request->name;
            $category->icon = $request->icon;
            $category->status = $request->status;
        }

        Cache::forget('categories');

        if ($hasChanges) {
            $category->save();
            notify()->success('Category Information Changed Successfully!');
            return redirect()->route('admin.category.index');
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
        $category = Category::with('subCategories.childCategories')->findOrFail($id);

        if ($category->subCategories->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please delete sub-categories and child-categories before deleting this category.'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully.'
        ]);
    }


    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        // return notify()->success('Category Status Changed Successfully!');
        return response()->json(['message' => 'Category Status Changed Successfully!']);
    }
}
