<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserLoggedResource;

class MeController extends Controller
{
    public function show()
    {
        return new UserLoggedResource(auth()->user());
    }
}
