<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as ControllerBase;

abstract class Controller extends ControllerBase
{
    use AuthorizesRequests, ValidatesRequests;
}
