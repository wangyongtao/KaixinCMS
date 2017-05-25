<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Watercart\Admins\Posts as PostModel;
use Watercart\Admins\Categories as CategoriesModel;

class PostsController extends Controller
{
    /**
     * 详情
     * @return \Illuminate\View\View
     */
    public function showDetail(Request $request, $id = 0)
    {
 
        $data = [];


        $result = (new PostModel())->find($id);
        if ($result) {
                $result = $result->toArray();

                $data['seo'] = [
                    'title'       => $result['title'],
                    'keywords'    =>  "关键词",
                    'description' => '',
                ];
                
        }
        $data['detailData'] = $result;

        return view('posts.postdetail', $data);
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

        $result = (new PostModel())->getListWithPaginate($where, $page);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        $data['categoryList'] = (new CategoriesModel())->getList();
        // $data['categoryCount'] = (new PostModel())->getListGroupByCategory();
// print_r($data);exit;

        $data['listData'] = $result;

        return view('posts.postlist', $data);
    }
}