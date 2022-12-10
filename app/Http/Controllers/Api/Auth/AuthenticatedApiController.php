<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginApiRequest;
use Auth;
use Illuminate\Http\Response;

class AuthenticatedApiController extends Controller
{
    public function login(LoginApiRequest $request)
    {
        $request->authenticate();

        $user = Auth::user();

        $user->tokens()->delete();

        return response()->json([
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'status' => 'true',

        ], Response::HTTP_OK);
    }
}
