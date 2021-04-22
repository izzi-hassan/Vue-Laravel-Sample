<?php

namespace App\Http\Controllers\Profile;

use App\Models\Channel;
use App\Models\Profile;
use App\Models\PrivacySettings;
use App\Models\ProfileSettings;
use App\Models\AccountSettings;
use function GuzzleHttp\Promise\exception_for;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function save(Request $request) {
        // TODO: Validate $request->all()

        $profile = Profile::updateOrCreate(
            $request->all()
        );

        return response()->json(['success' => true, 'profile' => $profile]);
    }

    public function get(Request $request, $id) {
        try {
            $profile = Profile::where('id', $id)->with(['badges', 'posts', 'city', 'shares', 'follows'])->firstOrFail();

            return response()->json(['success' => true, 'profile' => $profile]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Profile does not exist']);
        }
    }

    public function onboarding(Request $request) {
        $user = $request->user();
        if (is_null($user)) {
            return redirect()->route('login');
        } else if (is_null($user->profile)) {
            return $this->onboardingStepOne($request);
        } else if ($user->profile->channels->count() == 0)  {
            return $this->onboardingStepTwo($request);
        } else {
            return redirect()->route('app-entry');
        }
    }

    public function processOnboardingStepOne(Request $request) {
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $username = $request->input('username');
        $hide_name = $request->input('hide_name');      //need to test

        if (is_null($hide_name)) $hide_name = false;
        $email = $request->input('preferred_email');

        // TODO: check for email duplication (User exists)
        $user = $request->user();
        $user->email = $email;
        $user->name = $firstName . ' ' . $lastName;
        $user->username = $username;
        $user->save();

        // TODO: Make sure privacy settings are nullable or this will break;
        $privacySettings = new PrivacySettings();
        $privacySettings->user_id = $user->id;
        $privacySettings->hide_name = $hide_name;
        $privacySettings->save();

        // TODO: Make sure profile settings are nullable or this will break;
        $profileSettings = new ProfileSettings();
        $profileSettings->user_id = $user->id;
        $profileSettings->save();

        // TODO: Make sure account settings are nullable or this will break;
        $accountSettings = new AccountSettings();
        $accountSettings->user_id = $user->id;
        $accountSettings->save();

        // TODO: Send email verification link
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->slug = $username;
        $profile->first_name = $firstName;
        $profile->last_name = $lastName;
        $profile->save();

        // TODO:Need to send verification email if preferred email is different
        return redirect()->route('onboarding-step-two');
    }

    private function onboardingStepOne(Request $request) {
        $user = $request->user();
        $lastProvider = $user->last_auth;
        $lastAuthDetails = $user->{$lastProvider . "_auth"};

        $name_parts = explode(" ", $lastAuthDetails->name);
        $firstName = $name_parts[0];
        $lastName = $name_parts[1];

        $data = array(
            'user' => $user,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'authDetails' => $lastAuthDetails,
            'lastProvider' => $lastProvider
        );


        return view('onboarding.step-one', $data);
    }

    public function onboardingStepTwo(Request $request) {
        $user = $request->user();
        $lastProvider = $user->last_auth;
        $lastAuthDetails = $user->{$lastProvider . "_auth"};

        $channels = Channel::all();

        foreach ($channels as $index => $channel) {
            $channel['selected'] = false;

            if ($user->profile->subscribesTo($channel)) {
                $channel['selected'] = 'true';
            }

            $channels[$index] = $channel;
        }

        $data = array(
            'user' => $user,
            'authDetails' => $lastAuthDetails,
            'lastProvider' => $lastProvider,
            'channels' => $channels->toJson()
        );
        return view('onboarding.step-two', $data);
    }

    public function follow(Request $request, $profileId)
    {
        try {
            $user = $request->user();

            $profile = Profile::where('id', $profileId)->firstOrFail();
            $profile->addFollower($user->profile);

            return response()->json(['success' => true]);
        }
        catch (ModelNotFoundException $ex) {
            return response()->json(['success' => false, 'message' => 'Profile does not exist']);
        }
    }

    public function unFollow(Request $request, $profileId)
    {
        try {
            $user = $request->user();

            $profile = Profile::where('id', $profileId)->firstOrFail();
            $profile->removeFollower($user->profile);

            return response()->json(['success' => true]);
        }
        catch (ModelNotFoundException $ex) {
            return response()->json(['success' => false, 'message' => 'Profile does not exist']);
        }
    }
}
