<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\FooterSocialDataTable;
use App\Models\FooterSocial;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class FooterSocialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $dataTable)
    {
        $footerSocials = FooterSocial::all();
        return $dataTable->render('admin.footer.footer-socials.index', compact('footerSocials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'icon' => ['required', 'max:200'],
                'name' => ['required', 'max:200'],
                'url' => ['required', 'url'],
                'status' => ['required'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $footer = new FooterSocial();
        $footer->icon = $request->icon;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        Cache::forget('footer_socials');

        notify()->success('Created Footer Social Link Successfully!');

        return redirect()->route('admin.footer-social.index');
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
        $footer = FooterSocial::findOrFail($id);
        return view('admin.footer.footer-socials.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'icon' => ['required', 'max:200'],
                'name' => ['required', 'max:200'],
                'url' => ['required', 'url'],
                'status' => ['required'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $footer = FooterSocial::findOrFail($id);
        $footer->icon = $request->icon;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        Cache::forget('footer_socials');

        notify()->success('Updated Footer Social Link Successfully!');

        return redirect()->route('admin.footer-social.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterSocial::findOrFail($id);
        $footer->delete();

        Cache::forget('footer_socials');

        notify()->success('Deleted Footer Social Link Successfully!');

        return redirect()->route('admin.footer-social.index');
    }

    public function changeStatus(Request $request)
    {
        $footer = FooterSocial::findOrFail($request->id);
        $footer->status = $request->status == 'true' ? 1 : 0;
        $footer->save();

        Cache::forget('footer_socials');

        notify()->success('Status has been updated!');
        return redirect()->back();
    }
}