<?php

namespace App\Http\Controllers\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

use App\Models\Books\BooksModel;
use App\Models\Books\BookSectionsModel;
use App\Models\Books\BookTextsModel;

class BookController extends BaseController
{
    public function index(Request $request) {
        return $this->showList($request);
    }
    /**
     * 详情
     * @return \Illuminate\View\View
     */
    public function showDetail(Request $request, $id = 0)
    {
 
        $data = [];


        $result = (new BooksModel())->findOrFail($id);
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
     * 列表
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

        $result = (new BooksModel())->getListWithPaginate($where, $page);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        // $data['category'] = (new PostCategoryModel())->getArticleCategory();

        // $data['categoryCount'] = (new BooksModel())->getListCountGroupByCategory();

        $data['listData'] = $result;

        return view('default.books.bookList', $data);
    }
}