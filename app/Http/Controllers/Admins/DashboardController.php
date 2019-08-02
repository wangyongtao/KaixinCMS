<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers\Admins;

use App\Models\Articles;
use App\Models\Categories;
use App\Models\Links;
use App\Models\Users;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    /**
     * 详情.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $data = [];
        $data['LinkCount'] = Links::where('status', 1)->count();
        $data['PostCount'] = Articles::where('status', 1)->count();
        $data['CategoryCount'] = Categories::where('status', 1)->count();
        $data['UserCount'] = Users::where('id', '>=', 1)->count();

        return view('admins.dashboard', $data);
    }
}
