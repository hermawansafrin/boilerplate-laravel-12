<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\ApiLoginRequest;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    /**
     * @var AuthRepository
     */
    protected $repo;

    public function __construct(AuthRepository $authRepository)
    {
        $this->repo = $authRepository;
    }

    /**
     * @OA\Post(
     *       path="/authentication/login",
     *       summary="Login to systems and return the token and inits data.",
     *       tags={"Authentication"},
     *       description="Do Login",
     *
     *       @OA\Parameter(
     *           name="body",
     *           in="query",
     *           description="Login Username & Password",
     *           required=true,
     *
     *           @OA\Schema(
     *               type="object",
     *
     *               @OA\Property(
     *                   property="email",
     *                   type="string",
     *                   example="admin@mail.test"
     *               ),
     *               @OA\Property(
     *                   property="password",
     *                   type="string",
     *                   example="123456"
     *               )
     *           )
     *       ),
     *
     *       @OA\Response(
     *           response=200,
     *           description="successful operation",
     *       )
     *  )
     */
    public function login(ApiLoginRequest $request)
    {
        $inputRequest = $request;
        $input = $request->validated();

        $checkIsLogin = $this->repo->doLogin($inputRequest);

        if ($checkIsLogin == false) {
            return $this->sendError(__('auth.failed'), 401);
        }

        $loginUser = $this->repo->loginUser();
        if ($loginUser === null) {
            return $this->sendError(__('auth.login_failed'), 401);
        }

        return $this->sendResponse($loginUser, __('messages.auth.login_success'));
    }

    /**
     * @return Response
     *
     * @OA\Post(
     *      path="/authentication/logout",
     *      summary="Logout user.",
     *      tags={"Authentication"},
     *      description="Do Logout",

     *      security={{"Bearer":{}}},
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *      )
     * )
     */
    public function logout(Request $request)
    {
        $this->repo->logoutApi($request);

        return $this->sendResponse(null, __('messages.auth.logout_success'));
    }
}
