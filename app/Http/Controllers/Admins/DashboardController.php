<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Watercart\Admins\Posts as PostModel;
use Watercart\Admins\Categories as CategoriesModel;

class DashboardController extends AdminController
{
    /**
     * 详情
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
 
        $data = [];


        return view('admins.dashboard', $data);
    }
}