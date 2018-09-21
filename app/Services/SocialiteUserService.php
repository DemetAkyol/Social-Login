<?php

namespace App\Services;

use App\Models\SocialiteUser;
use App\Repositories\SocialRepository;

class SocialiteUserService
{

    private $searchRepository;

    public function __construct()
    {
        $this->searchRepository = new SocialRepository();
    }


    public function createOrGetUser($id, $email, $name)
    {
        /*
        * provider'dan gelen user id ile kullanıcı getir
        */
        // $socialiteUser = SocialAccountModel::whereProvider('facebook')->whereProviderUserId($providerUser->getId())->first();
        $socialiteUser = $this->searchRepository->GetProviderUser($id);

        if ($socialiteUser) {
            return $socialiteUser->user;


        } else {


            $socialiteUser = new SocialiteUser([
                'provider_user_id' => $id,
                'provider' => 'facebook'
            ]);


            $user=$this->searchRepository->GetUser($email);

            if (!$user) {
                $user = User::create(
                    [
                        'email' => $email,
                        'name' => $name,
                    ]
                );
            }

            $socialiteUser->user()->associate($user);
            $socialiteUser->save();

            return $user;

        }

    }

    public function googleLogin($request){

        $google_redirect_url = route('glogin');
        $gClient = new \Google_Client();
        $gClient->setApplicationName(config('services.google.app_name'));
        $gClient->setClientId(config('services.google.client_id'));
        $gClient->setClientSecret(config('services.google.client_secret'));
        $gClient->setRedirectUri($google_redirect_url);
        //$gClient->setDeveloperKey(config('services.google.api_key'));
        $gClient->setScopes(array(
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ));

        $google_oauthV2 = new \Google_Service_Oauth2($gClient);
        if ($request->get('code')) {
            $gClient->authenticate($request->get('code'));
            $request->session()->put('token', $gClient->getAccessToken());
        }
        if ($request->session()->get('token')) {
            $gClient->setAccessToken($request->session()->get('token'));
        }
        if ($gClient->getAccessToken()) {
            //For logged in user, get details from google using access token
            $guser = $google_oauthV2->userinfo->get();

            $request->session()->put('name', $guser['name']);

            $user=$this->searchRepository->GetUser($guser['email']);

            if ($user) {
                auth()->login($user);

                return redirect()->to('/home');
            } else {
                //register your user with response data
                $user=$this->searchRepository->CreateUser($guser['email'],$guser['name']);

                auth()->login($user);

                return redirect()->to('/home');
            }

        } else {
            //For Guest user, get google login url
            $authUrl = $gClient->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }









}