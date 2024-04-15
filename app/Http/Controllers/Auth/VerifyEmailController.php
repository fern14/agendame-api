<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\VerifiedEmail;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Resources\User\UserLoggedResource;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(VerifyEmailRequest $request): UserLoggedResource
    {
        $input = $request->validated();

        $user_verified = new VerifiedEmail($input['token']);

        return $user_verified->verified_email();
    }
}
