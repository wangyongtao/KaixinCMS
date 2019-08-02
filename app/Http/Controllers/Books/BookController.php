<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers\Books;

use App\Http\Controllers\BaseController;
use App\Models\Books\Books;
use Illuminate\Http\Request;

class BookController extends BaseController
{
    public function index(Request $request)
    {
        return $this->showList($request);
    }

    /**
     * 详情.
     *
     * @param mixed $id
     *
     * @return \Illuminate\View\View
     */
    public function showDetail(Request $request, $id = 0)
    {
        $data = [];

        $result = (new Books())->findOrFail($id);
        if ($result) {
            $result = $result->toArray();

            // $data['seo'] = [
                //     'title'       => $result['title'],
                //     'keywords'    =>  "关键词",
                //     'description' => '',
                // ];
        }
        $data['detailData'] = $result;

        return view('default.books.bookDetail', $data);
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
        $data = [];
        $where = [];
        if ($category) {
            $where['category'] = $category;
        }

        $result = (new Books())->getListWithPaginate($where, $page);
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }

        // $data['category'] = (new PostCategories())->getArticleCategory();

        // $data['categoryCount'] = (new BooksModel())->getListCountGroupByCategory();

        $data['listData'] = $result;

        return view('default.books.bookList', $data);
    }
}
