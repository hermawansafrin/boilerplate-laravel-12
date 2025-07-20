<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Auth\WebLoginRequest;
use App\Repositories\Auth\AuthRepository;

class AuthController extends BaseController
{
    public string $LANG_PATH = 'web_auth.';

    public AuthRepository $repo;

    /**
     * Constructor
     */
    public function __construct(AuthRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Login page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $isLogin = $this->repo->isLogin();

        if ($isLogin) {
            return redirect()->route('dashboard.index');
        }

        $dataView = [
            'LANG_PATH' => $this->LANG_PATH,
        ];

        return view('admin.auth', $dataView);
    }

    /**
     * Post login logic request
     */
    public function postLogin(WebLoginRequest $request)
    {
        $doLogin = $this->repo->doLogin($request);

        if ($doLogin) {
            /** if success, redirect to index for go to the dashboard page */
            return $this->index();
        }

        /** if failed, redirect back with error message */
        return redirect()
            ->route('login')
            ->withErrors(['attempt' => __('auth.failed')]);
    }

    /**
     * Logout logic
     */
    public function logout()
    {
        $this->repo->logout();

        return redirect()->route('login');
    }
}
