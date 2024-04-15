<?php

namespace App\Jobs;

use App\Models\User;
use App\Http\Resources\User\UserLoggedResource;
use App\Exceptions\InvalidTokenException;
use App\Exceptions\UserAlreadyVerified;

class VerifiedEmail 
{
    public function __construct(protected $token) { }

    public function verified_email(): UserLoggedResource
    {
        $user = User::query()->whereToken($this->token)->first();

        if (!$user) throw new InvalidTokenException();

        if ($user->email_verified_at) throw new UserAlreadyVerified();

        $user->email_verified_at = now();

        $user->save();

        return new UserLoggedResource($user);
    }
}