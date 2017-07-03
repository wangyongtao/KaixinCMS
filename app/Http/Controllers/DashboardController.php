<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Watercart\Admins\Posts as PostModel;
use Watercart\Admins\LinkModel;
use Watercart\Admins\Categories as CategoriesModel;
use Watercart\Admins\UserModel;

class DashboardController extends AdminController
{
    /**
     * 详情
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
 
        $data = [];
        $data['LinkCount'] = LinkModel::where('status', 1)->count();
        $data['PostCount'] = PostModel::where('status', 1)->count();
        $data['CategoryCount'] = CategoriesModel::where('status', 1)->count();
        $data['UserCount'] = UserModel::where('id', '>=', 1)->count();

        return view('admins.dashboard', $data);
    }
}