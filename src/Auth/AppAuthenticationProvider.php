<?php

namespace Hechoenlaravel\JarvisFoundation\Auth;

use Auth;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Route;
use Dingo\Api\Contract\Auth\Provider;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AppAuthenticationProvider implements Provider
{
    public function authenticate(Request $request, Route $route)
    {
        if(!Auth::check()) {
            throw new UnauthorizedHttpException('Unable to authenticate with supplied username and password.');
        }
    }
}