<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'banner' => ['required', 'image', 'max:2046'],
                'type' => ['string', 'max:100'],
                'title' => ['required', 'max:200'],
                'starting_price' => ['required', 'max:200'],
                'btn_url' => ['url'],
                'serial' => ['required', 'integer'],
                'status' => ['required'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $slider = new Slider();

        $imagePath = $this->uploadImage($request, 'banner', 'uploads');

        $slider->banner = $imagePath;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();
        notify()->success('Banner Slider Information Uploaded Successfully!');


        return redirect()->route('admin.slider.index');
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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'banner' => ['required', 'image', 'max:2046'],
                'type' => ['string', 'max:100'],
                'title' => ['required', 'max:200'],
                'starting_price' => ['required', 'max:200'],
                'btn_url' => ['url'],
                'serial' => ['required', 'integer'],
                'status' => ['required'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $slider = Slider::findOrFail($id);

        $hasChanges = false;
        $imagePath = $this->uploadImage($request, 'banner', 'uploads');

        if (
            $slider->type !== $request->type ||
            $slider->title !== $request->title ||
            $slider->starting_price !== $request->starting_price ||
            $slider->btn_url !== $request->btn_url ||
            $slider->serial !== $request->serial ||
            $slider->status !== $request->status
        ) {
            $hasChanges = true;
            $slider->type = $request->type;
            $slider->title = $request->title;
            $slider->starting_price = $request->starting_price;
            $slider->btn_url = $request->btn_url;
            $slider->serial = $request->serial;
            $slider->status = $request->status;
        };

        $slider->banner = empty(!$imagePath) ? $imagePath : $slider->banner;

        Cache::forget('sliders');

        if ($hasChanges) {
            $slider->save();
            notify()->success('Banner Slider Information Uploaded Successfully!');
            return redirect()->route('admin.slider.index');
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
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->banner);
        $slider->delete();

        notify()->success('Banner Slider Information Deleted Successfully!');

        return redirect()->back();
    }
}