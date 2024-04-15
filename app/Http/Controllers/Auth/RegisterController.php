<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Exceptions\UserHasBeenTakenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserLoggedResource;
use App\Models\User;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
     /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request): UserLoggedResource
    {
        $input = $request->validated();

        if (User::query()->whereEmail($input['email'])->exists()) throw new UserHasBeenTakenException();

        $input['password'] = bcrypt($input['password']);
        $input['token'] = Str::uuid();
        
        $user = User::query()->create($input);

        event(new UserRegistered($user));

        return new UserLoggedResource($user);
    }
}
