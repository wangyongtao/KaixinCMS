<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admins\AdminController;
use Illuminate\Support\Facades\DB;

use App\Models\Post\PostModel;
use App\Models\Post\PostCategoryModel;

class PostsController extends BaseController
{
    /**
     * 列表
     * @return string
     */
    public function index(Request $request)
    {
        return $this->showList($request);
    }
 
    /**
     * 关于我们
     * @return \Illuminate\View\View
     */
    public function showDetail(Request $request, $id = 0)
    {
 
        $data = [];


        $result = (new PostModel())->find($id);
        if (empty($result)) {
            return view('errors.404');
        }
        $result = $result->toArray();

        $data['seo'] = [
            'title'       => $result['title'],
            'keywords'    =>  "关键词",
            'description' => '',
        ];
        $data['detailData'] = $result;

        return view('default.posts.postdetail', $data);
    }

    /**
     * 列表
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

        $result = (new PostModel())->getListWithPaginate($where, $page);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        $data['categoryList'] = (new PostCategoryModel())->getListByPlatform();

        $data['categoryCount'] = (new PostModel())->getListCountGroupByCategory();

        $data['listData'] = $result;
// print_r($data['categoryList']);exit;
        return view('default.posts.postlist', $data);
    }

    public function getListByCategoryName(){
        
    }

}