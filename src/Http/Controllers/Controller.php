<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use ValidatesRequests;
}
