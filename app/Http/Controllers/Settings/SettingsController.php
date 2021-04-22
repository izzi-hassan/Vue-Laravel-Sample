<?php
namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use App\Models\PrivacySettings;

abstract class SettingsController extends Controller
{
    public function save(Request $request) {
        //TODO: Validate $request->all()

        $settings = null;
        switch(get_class($this)) {
            case 'PrivacySettingsController':
                $settings = PrivacySettings::where('user_id', $request->user()->id)->get(1);
                break;
            case 'AccountSettingsController':
                $settings = AccountSettings::where('user_id', $request->user()->id)->get(1);
                break;
            case 'ProfileSettingsController':
                $settings = ProfileSettings::where('user_id', $request->user()->id)->get(1);
                break;
        }

        $settings->fill($request->all());
        $settings->save();
    }
}