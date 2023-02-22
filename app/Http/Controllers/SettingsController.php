<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        // dd($settings);
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'copyright_text' => 'required',
            'meta_keywords' => 'required',

        ]);

        // Clear Settings Cache
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Cache::flush();


        $settings = Setting::firstOrNew();
        $settings->site_name = $request->site_name;
        $settings->copyright_text = $request->copyright_text;
        $settings->meta_title = $request->meta_title;
        $settings->meta_description = $request->meta_description;
        $settings->keywords = $request->meta_keywords;

        // ٗUpdate Social

        $settings->whatsapp_no = $request->whatsapp_no;
        $settings->youtube_link = $request->youtube_link;
        $settings->pinterest_link = $request->pinterest_link;
        $settings->linkedin_link = $request->linkedin_link;
        $settings->facebook_link = $request->facebook_link;
        $settings->twitter_link = $request->twitter_link;
        $settings->instagram_link = $request->instagram_link;


        // Handle Files
        if ($request->hasFile('logo')) {

            $uuid = Str::uuid()->toString();
            $file = $uuid . '.' . $request->logo->extension();
            $settings->site_logo = $file;
            $request->logo->move(public_path('site-settings/logos'),  $file);
        }
        if ($request->hasFile('favicon')) {
            $uuid = Str::uuid()->toString();
            $file = $uuid . '.' . $request->favicon->extension();
            $settings->favicon = $file;
            $request->favicon->move(public_path('site-settings/favicons'),  $file);
        }
        $settings->save();
        return to_route('settings.index')->withSuccess('Settings Have Been Updated Successfully');
    }
}
