<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //

    public function index()
    {
        $colors = Setting::where('key', 'website_color_setting')->first();
        $colors = $colors ? json_decode($colors->value, true) : [];
        $data['website_color'] = $colors;

        $website_setting = Setting::where('key', 'website_logo_setting')->first();
        $website_setting = $website_setting ? json_decode($website_setting->value, true) : [];
        $data['website_logo_setting'] = $website_setting;


        $website_social_media = Setting::where('key', 'website_social_media')->first();
        $website_social_media = $website_social_media ? json_decode($website_social_media->value, true) : [];
        $data['website_social_media'] = $website_social_media;


        $website_common_info = Setting::where('key', 'website_common_info')->first();
        $website_common_info = $website_common_info ? json_decode($website_common_info->value, true) : [];
        $data['website_common_info'] = $website_common_info;

        $particle_js_type = Setting::where('key', 'particle_js_type')->first();
        $particle_js_type = $particle_js_type ? json_decode($particle_js_type->value, true) : [];
        $data['particle_js_type'] = $particle_js_type;
        $home_banner_sliders = Setting::where('key', 'home_banner_slider')->first();
        $home_banner_sliders = $home_banner_sliders
            ? json_decode($home_banner_sliders->value, true)
            : [];
        $data['home_banner_sliders'] = $home_banner_sliders;
        // $data['particle_js_type'] = Setting::where('key', 'particle_js_type')->first();
        return view('backend.admin.settings.setting_index', $data);
    }

    public function websiteStore(Request $request)
    {
        $request->validate([
            'primary_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'secondary_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'top_nav_bar_bg_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'top_nav_bar_sub_bg_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'top_nav_holder_bg_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'secondary_light_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'footer_bg_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ]);

        $colors = [
            'primary_color' => $request->primary_color ?? '#000000',
            'secondary_color' => $request->secondary_color ?? '#000000',
            'top_nav_bar_bg_color' => $request->top_nav_bar_bg_color ?? '#000000',
            'top_nav_bar_sub_bg_color' => $request->top_nav_bar_sub_bg_color ?? '#000000',
            'top_nav_holder_bg_color' => $request->top_nav_holder_bg_color ?? '#000000',
            'secondary_light_color' => $request->secondary_light_color ?? '#000000',
            'footer_bg_color' => $request->footer_bg_color ?? '#000000',
        ];
        Setting::updateOrInsert(
            ['key' => 'website_color_setting'],
            ['value' => json_encode($colors)]
        );

        return redirect()
            ->route('admin.settings')
            ->with('success', 'Website colors updated');
    }

    public function logoStore(Request $request)
    {
        $existing = Setting::where('key', 'website_logo_setting')->first();

        $data = [];

        // Load existing data safely
        if ($existing && $existing->value) {
            $data = json_decode($existing->value, true) ?? [];
        }

        // Upload only if file exists → overwrite that key only

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('logos');
        }

        if ($request->hasFile('logo_light')) {
            $data['logo_light'] = $request->file('logo_light')->store('logos');
        }

        if ($request->hasFile('logo_dark')) {
            $data['logo_dark'] = $request->file('logo_dark')->store('logos'); //  fixed
        }
        if ($request->hasFile('footer_bg_image')) {
            $data['footer_bg_image'] = $request->file('footer_bg_image')->store('logos'); // fixed
        }

        // Save only if something exists
        if (!empty($data)) {
            Setting::updateOrInsert(
                ['key' => 'website_logo_setting'],
                ['value' => json_encode($data)]
            );
        }

        return redirect()->route('admin.settings')->with('success', 'Website logo updated');
    }
    public function websiteInfoStore(Request $request)
    {
        $data = [
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'open_hours' => $request->open_hours,
            'footer_about' => $request->footer_about,
            'footer_copy_right' => $request->footer_copy_right,
            'web_name' => $request->web_name,
            'web_short_desc' => $request->web_short_desc,
            'map_url' => $request->map_url,
            'map_lat' => $request->map_lat,
            'map_lng' => $request->map_lng,
        ];
        if (!empty($data)) {
            Setting::updateOrInsert(
                ['key' => 'website_common_info'],
                ['value' => json_encode($data)]
            );
        }
        return redirect()->route('admin.settings')->with('success', 'Website Information updated');
    }
    public function socialMediaStore(Request $request)
    {
        $data = [
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'pinterest' => $request->pinterest,
            'whatsapp' => $request->whatsapp,
            'telegram' => $request->telegram,
        ];
        if (!empty($data)) {
            Setting::updateOrInsert(
                ['key' => 'website_social_media'],
                ['value' => json_encode($data)]
            );
        }
        return redirect()->route('admin.settings')->with('success', 'Website urls updated');
    }

    public function particleJsTypeStore(Request $request)
    {
        $existing = Setting::where('key', 'particle_js_type')->first();
        $oldData = $existing ? json_decode($existing->value, true) : [];

        $data = [
            'type' => $request->particle_type,
            'title_1' => $request->title_1,
            'subtitle_1' => $request->subtitle_1,
            'title_2' => $request->title_2,
            'subtitle_2' => $request->subtitle_2,
            'title_3' => $request->title_3,
            'subtitle_3' => $request->subtitle_3,
        ];
        if ($request->hasFile('slider_image')) {
            $data['slider_image'] = $request->slider_image->store('/slider');
        } else {
            $data['slider_image'] = $oldData['slider_image'] ?? null;
        }

        Setting::updateOrInsert(
            ['key' => 'particle_js_type'],
            ['value' => json_encode($data)]
        );

        return redirect()->route('admin.settings')->with('success', 'Particle type updated');
    }

    public function home_banner_slider_store(Request $request)
    {
        $old = Setting::where('key', 'home_banner_slider')->first();

        $oldData = $old ? json_decode($old->value, true) : [];

        $sliders = [];
        // pre($request->all());
        // die;

        if ($request->has('sliders')) {

            foreach ($request->sliders as $index => $slider) {

                $image = $oldData[$index]['image'] ?? null;

                if ($request->hasFile("sliders.$index.image")) {
                    $image = $request->file("sliders.$index.image")->store('home-banner');
                }

                $sliders[] = [
                    'image' => $image,
                    'small_title' => $slider['small_title'] ?? '',
                    'title_1' => $slider['title_1'] ?? '',
                    'title_2' => $slider['title_2'] ?? '',
                    'title_3' => $slider['title_3'] ?? '',
                    'button_text' => $slider['button_text'] ?? '',
                    'button_url' => $slider['button_url'] ?? '',
                    // 'volunteer_count' => $slider['volunteer_count'] ?? '',
                    // 'volunteer_text' => $slider['volunteer_text'] ?? '',
                    'since_year' => $slider['since_year'] ?? '',
                    'based_location' => $slider['based_location'] ?? '',
                ];
            }
        }

        Setting::updateOrCreate(
            ['key' => 'home_banner_slider'],
            [
                'value' => json_encode($sliders)
            ]
        );

        return redirect()->back()->with('success', 'Home banner sliders updated successfully.');
    }

    public function workingHoursStore(Request $request)
    {
        $working_hours = [];

        if ($request->working_hours) {

            foreach ($request->working_hours as $day => $data) {

                $working_hours[$day] = [
                    'open' => $data['open'] ?? '',
                    'close' => $data['close'] ?? '',
                    'closed' => isset($data['closed']) ? 1 : 0,
                ];
            }
        }

        Setting::updateOrCreate(
            [
                'key' => 'working_hours'
            ],
            [
                'value' => json_encode($working_hours)
            ]
        );

        return redirect()->back()->with(
            'success',
            'Working hours updated successfully.'
        );
    }
}
