<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers\Post;

use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 列表.
     *
     * @return string
     */
    public function index(Request $request)
    {
        return $this->showList($request);
    }

    /**
     * 关于我们.
     *
     * @param mixed $id
     *
     * @return \Illuminate\View\View
     */
    public function showDetail(Request $request, $id = 0)
    {
        $data = [];

        $result = (new Posts())->find($id);
        if (empty($result)) {
            return view('errors.404');
        }
        $result = $result->toArray();

        $data['seo'] = [
            'title' => $result['title'],
            'keywords' => '关键词',
            'description' => '',
        ];
        $data['detailData'] = $result;

        return view('default.posts.postdetail', $data);
    }

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
        $category = $request->input('category', '');
        $data = [];
        $where = [];
        if ($category) {
            $where['category'] = $category;
        }

        $result = (new Posts())->getListWithPaginate($where, $page);
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }

        $data['categoryList'] = (new Categories())->getListByPlatform();

        $data['categoryCount'] = (new Posts())->getListCountGroupByCategory();

        $data['listData'] = $result;
        // print_r($data['categoryList']);exit;
        return view('default.posts.postlist', $data);
    }
}
