<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 列表.
     *
     * @param Request $request
     *
     * @return string
     */
    public function index(Request $request)
    {
        $data = $this->showList($request);

        $data['headline'] = '首页推荐';
        // print_r($data['categoryList']);exit;
        return view('default.posts.postList', $data);
    }

    public function showPopularList(Request $request)
    {
        $data = $this->showList($request);

        $data['headline'] = '热门文章';
        // print_r($data['categoryList']);exit;
        return view('default.posts.postList', $data);
    }

    /**
     * 关于我们.
     *
     * @param Request $request
     * @param mixed   $id
     *
     * @return \Illuminate\View\View
     */
    public function showDetail(Request $request, $id = 0)
    {
        $data = [];

        $result = (new Articles())->find($id);
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

        return view('default.posts.postDetail', $data);
    }

    /**
     * 列表.
     *
     * @param Request $request
     * @param mixed   $category
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

        $result = (new Articles())->getListWithPaginate(collect([
            'where' => $where,
            'page' => $page,
        ]));
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }

        $data['categoryList'] = (new Categories())->getListByPlatform();

        $data['categoryCount'] = (new Articles())->getListCountGroupByCategory();

        $data['listData'] = $result;

        return $data;
    }
}
