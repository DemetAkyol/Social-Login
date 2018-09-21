<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Services\SocialiteUserService;
use Illuminate\Http\Request;


class SocialController extends Controller
{
    private $socialService;

    public function __construct()
    {
        $this->socialService = new SocialiteUserService();
    }

    public function loginFacebook(Request $request, SocialiteUserService $service)
    {
        if ($request != null && $request->id != null) {
            $user = $service->createOrGetUser($request->id, $request->email, $request->first_name);
            //  auth()->login($user);
            if (!$user) {
                return "/login";
            }
            auth()->login($user);
            return "/home";
        } else {
            return "/login";
        }

    }

    public function googleLogin(Request $request)
    {

        return $this->socialService->googleLogin($request);

    }

}
