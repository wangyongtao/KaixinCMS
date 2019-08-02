<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers;

use App\Models\Admins\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * 列表.
     *
     * @param mixed $category
     *
     * @return string
     */
    public function showList(Request $request, $category = '')
    {
        $page = $request->input('page', 0);
        $data = [];
        $where = [];
        if ($category) {
            $where['category'] = $category;
        }

        $result = (new Tags())->getListWithPaginate(collect([
            'where' => $where,
            'page' => $page,
        ]));
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }
        $data['listData'] = $result;

        return view('posts.postlist', $data);
    }
}
