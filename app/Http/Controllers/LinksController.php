<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Watercart\Admins\Categories as Categories;
use Watercart\Admins\LinkModel;

class LinksController extends Controller
{
    /**
     * 列表.
     *
     * @param Request $request
     *
     * @return string
     */
    public function show(Request $request)
    {
        $result = (new Links())->getListAll(collect([
            'where' => [],
            'pageSize' => 1000,
            'page' => 0,
        ]));
        // print_r($result);
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }

        $data['categoryList'] = (new Categories())->getLinksCategoryList();
        // $data['categoryCount'] = (new PostModel())->getListGroupByCategory();
        // print_r($data);exit;

        $data['listData'] = $result;

        return view('default.linkList', $data);
    }

    public function add(Request $request)
    {
        if (null !== $request->input('_submit')) {
            $response = [
                'code' => 0,
                'msg' => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['platform'] = 'posts';
            $input['module'] = $request->input('module', 'links');

            $input['link_name'] = $request->input('link_name', '');
            $input['link_name_en'] = $request->input('link_name_en', '');
            $input['link_url'] = $request->input('link_url');
            $input['notes'] = $request->input('notes');
            // $input['created_at']  = date('Y-m-d H:i:s');
            $input['updated_at'] = date('Y-m-d H:i:s');

            $result = (new LinkModel())->add(collect($input));

            if ($result) {
                $response['code'] = 1;
                $response['data'] = $result;
            }
            // print_r($input);
            return response($response, 200);
        }
        $data['categoryList'] = (new Categories())->getList();
        $data['parentCategoryList'] = (new Categories())->getParentCategoryList();

        $data['options'] = [];
        $data['options']['parent_id'] = collect($data['parentCategoryList'])->mapWithKeys(function ($item) {
            // print_r($item);
            return [$item['category_id'] => $item['category_name']];
        });

        return view('admins.links.add', $data);
    }

    /**
     * @param mixed $id
     */
    public function edit(Request $request, $id = 0)
    {
        if (null !== $request->input('_submit')) {
            $response = [
                'code' => 0,
                'msg' => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['platform'] = 'posts';
            $input['module'] = $request->input('module', 'links');

            $input['link_name'] = $request->input('link_name', '');
            $input['link_name_en'] = $request->input('link_name_en', '');
            $input['link_url'] = $request->input('link_url');
            $input['notes'] = $request->input('notes');
            // $input['created_at']  = date('Y-m-d H:i:s');
            $input['updated_at'] = date('Y-m-d H:i:s');

            $where = [
                'id' => $id,
            ];
            $result = DB::table('ks_links')
                ->where($where)
                ->update($input)
            ;
            if ($result) {
                $response['code'] = 1;
            }
            // print_r($input);
            return response($response, 200);
        }

        $result = (new LinkModel())->find($id);
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }

        $data['categoryList'] = (new Categories())->getList();
        $data['parentCategoryList'] = (new Categories())->getParentCategoryList();

        $result = $result->toArray();
        $data['detail'] = $result;
        $data['options'] = [];
        $data['options']['parent_id'] = collect($data['parentCategoryList'])->mapWithKeys(function ($item) {
            // print_r($item);
            return [$item['category_id'] => $item['category_name']];
        });

        return view('admins.links.edit', $data);
    }
}
