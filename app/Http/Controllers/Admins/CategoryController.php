<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Watercart\Admins\Posts as PostModel;
use Watercart\Admins\Categories as CategoryModel;
use App\Http\Controllers\Admins\AdminController;

class CategoryController extends AdminController
{
    /**
     * 列表
     * @return string
     */
    public function index(Request $request, $category = '')
    {
        $page = $request->input('page', 0);
        $data = [];
        $where = [];
        if ($category) {
            $where['category'] = $category;
        }
 
        $data['categoryList'] = (new CategoryModel())->getList();
        // $data['categoryCount'] = (new PostModel())->getListGroupByCategory();
// print_r($data);exit;
		$categoryMenu = collect($data['categoryList'])->groupBy('platform');
		
		$data['categoryMenu'] = $categoryMenu->toArray();
 
        return view('admins.categories.list', $data);
    }
}