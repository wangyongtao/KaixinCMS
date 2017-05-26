<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as CoreController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Admins\AdminController;

class AdminController extends CoreController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



}
