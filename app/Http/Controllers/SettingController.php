<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $data = Setting::first() ?? new Setting();

        return view('settings.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site'    => 'required|string',
            'name'    => 'required|string',
            'archive_name'   => 'required|string',
            'archive' => 'nullable|file|mimes:pdf|max:5120',
            'companie_name' => 'nullable|string',
            'companie_description' => 'nullable|string',
        ]);

        $setting = Setting::first() ?? new Setting();

        // upload PDF
        if ($request->hasFile('archive')) {
            $file = $request->file('archive');
            $path = $file->store('public/settings');
            $setting->archive = str_replace('public/', '', $path);
        }

        $setting->site  = $request->site;
        $setting->name  = $request->name;
        $setting->archive_name = $request->archive_name;
        $setting->save();

         return redirect()
        ->route('home')
        ->with('toast_warning', 'Configurações salvas!');

}
}