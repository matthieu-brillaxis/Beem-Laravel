<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', []);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $me = Auth::guard()->user();

        return response()
            ->json(
                $me
            );
    }

    public function getUser($id)
    {
        $user = User::with('places')->find($id);

        return response()
            ->json(
                $user
            );
    }

    // Update current user

    public function updateUser(Request $request)
    {
        
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $email = $request->input('email');
        $id = Auth::guard()->user()->id;

        $user = User::where('id',$id)->update(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email]);
        $user = User::find($id);

        return response()
            ->json(
                $user
            );
    }
}
