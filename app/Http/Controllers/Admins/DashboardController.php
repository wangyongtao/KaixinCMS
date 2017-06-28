<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Models\Posts as PostModel;
use App\Models\LinkModel;
use App\Models\Categories as CategoriesModel;
use App\Models\UserModel;

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