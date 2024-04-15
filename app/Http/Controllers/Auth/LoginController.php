<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidAuthenticationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request): UserResource
    {
        $input = $request->validated();

        if (!auth()->attempt($input)) {
            throw new InvalidAuthenticationException();
        }

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        return new UserResource(auth()->user(), $token);
    }
}
