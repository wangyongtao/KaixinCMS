<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Controllers\Admins\AdminController;
use Illuminate\Support\Facades\DB;

use App\Models\LinkModel;
use App\Models\CategoryModel;

class LinksController extends AdminController
{
    /**
     * 列表
     * @return string
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 0);
        $category = $request->input('category', '');
        $data = [];
        $where = [];
        if ($category) {
            $where['category'] = $category;
        }

        $result = (new LinkModel())->getListWithPaginate($where, $page);
        // print_r($result);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        $data['categoryList'] = (new CategoryModel())->getListByModule('links');
        // $data['categoryCount'] = (new PostModel())->getListGroupByCategory();
// print_r($data);exit;

        $data['listData'] = $result;

        return view('admins.links.list', $data);
    }


    /**
     *
     */
    public function add(Request $request)
    {

        if ( $request->input('_submit') !== null ) {
            $response = [
                'code' => 0,
                'msg'  => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['platform'] = 'posts';
            $input['module'] = $request->input('module', 'links');

            $input['link_name']   = $request->input('link_name', '');
            $input['link_name_en']   = $request->input('link_name_en', '');
            $input['link_url']   = $request->input('link_url');
            $input['notes']   = $request->input('notes');
            // $input['created_at']  = date('Y-m-d H:i:s');
            $input['updated_at']  = date('Y-m-d H:i:s');



            $result = (new LinkModel())->saveData(collect($input));

            if ($result) {
                $response['code'] = 1;
                $response['data'] = $result;
            }
        // print_r($input);
            return response($response, 200);

        }
        $data['categoryList'] = (new CategoryModel())->getList();
        $data['parentCategoryList'] = (new CategoryModel)->getParentCategoryList();
 
        $data['options'] = array();
        $data['options']['parent_id'] = collect($data['parentCategoryList'])->mapWithKeys(function($item){
            // print_r($item);
            return [$item['category_id'] => $item['category_name']];
        });

        return view('admins.links.add', $data);
    }

        /**
     *
     */
    public function edit(Request $request, $id=0)
    {
        if ( $request->input('_submit') !== null ) {
            $response = [
                'code' => 0,
                'msg'  => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['platform'] = 'posts';
            $input['module'] = $request->input('module', 'links');

            $input['link_name']   = $request->input('link_name', '');
            $input['link_name_en']   = $request->input('link_name_en', '');
            $input['link_url']   = $request->input('link_url');
            $input['notes']   = $request->input('notes');
            // $input['created_at']  = date('Y-m-d H:i:s');
            $input['updated_at']  = date('Y-m-d H:i:s');



            $where = [
                'id' => $id,
            ];
            $result = DB::table('ks_links')
                ->where($where)
                ->update($input);
            if ($result) {
                $response['code'] = 1;
            }
        // print_r($input);
            return response($response, 200);
        }

        $result = (new LinkModel())->find($id);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        $data['categoryList'] = (new CategoryModel())->getList();
        $data['parentCategoryList'] = (new CategoryModel)->getParentCategoryList();

        $result = $result->toArray();
        $data['detail'] = $result;
        $data['options'] = array();
        $data['options']['parent_id'] = collect($data['parentCategoryList'])->mapWithKeys(function($item){
            // print_r($item);
            return [$item['category_id'] => $item['category_name']];
        });
        

        return view('admins.links.edit', $data);
    }

}