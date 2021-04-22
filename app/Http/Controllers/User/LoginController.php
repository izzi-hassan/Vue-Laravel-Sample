<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\ClientException;
use Socialite;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Socialite\Two\InvalidStateException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(String $provider)
    {
        $socialUser = null;

        try {
            $socialUser = Socialite::driver($provider)->user();

            if (is_null($socialUser))
                redirect()->route('login');

            $existingUser = User::where('email', $socialUser->email)->firstOrFail();

            // add new auth json
            $existingUser->{$provider . "_auth"} = $socialUser;
            $existingUser->last_auth = $provider;
            $existingUser->save();

            return $this->authenticateAndRedirect($existingUser);
        } catch (InvalidStateException $e) {
            dd($e);
            // Refreshed the page
            return redirect()->route('login');
        } catch (ClientException $e) {
            dd('client exception');
            // Cancelled by user
            return view('pages.login');
        } catch (ModelNotFoundException $e) {
            // Create new User record
            $user = new User;
            $user->username = $socialUser->nickname;
            $user->email = $socialUser->email;
            $user->password = null;
            $user->{$provider . "_auth"} = $socialUser;
            $user->last_auth = $provider;

            $user->save();

            return $this->authenticateAndRedirect($user);
        }

    }

    public function loginPage(Request $request) {
        $user = $request->user();
        if (is_null ($user)) {
            return view('pages.login');
        } else {
            return redirect()->route('app-entry');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('micro-home');
    }

    private function authenticateAndRedirect(User $user) {
        Auth::login($user, true);
        $user->last_login = Carbon::now();
        $user->update();

        return redirect()->route('app-entry');
    }
}