<?php

namespace Selvah\Http\Controllers\API;

use Selvah\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selvah\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(auth()->user()->notifications);
    }
}
