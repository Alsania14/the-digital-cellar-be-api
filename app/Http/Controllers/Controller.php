<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="The Digital Cellar BE API", version="1")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
