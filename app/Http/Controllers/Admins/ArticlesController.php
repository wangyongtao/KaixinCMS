<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers\Admins;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class ArticlesController extends AdminController
{
    /**
     * 列表.
     *
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

        $result = (new Articles())->getListWithPaginate(collect([
            'where' => $where,
            'page' => $page,
        ]));
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }

        $data['categoryList'] = (new Categories())->getListByModule('posts');
        // $data['categoryCount'] = (new PostModel())->getListGroupByCategory();
        // print_r($data);exit;

        $data['listData'] = $result;

        return view('admins.posts.list', $data);
    }

    public function add(Request $request)
    {
        $type = '';

        try {
            if ('category' === $type) {
                $content = Yaml::parse(file_get_contents(config_path('admins/category.yaml')));
            } elseif ('links' === $type) {
                $content = Yaml::parse(file_get_contents(config_path('admins/links.yaml')));
            } elseif ('books' === $type) {
                $content = Yaml::parse(file_get_contents(config_path('admins/books.yaml')));
            }
            // print_r($content);
        } catch (ParseException $e) {
            printf('Unable to parse the YAML string: %s', $e->getMessage());
        }
        if (null !== $request->input('title')) {
            $response = [
                'code' => 0,
                'msg' => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['platform'] = 'posts';
            $input['category'] = $request->input('category', '');

            $input['title'] = $request->input('title');
            $input['source_name'] = $request->input('source_name', '网络');
            $input['source_link'] = $request->input('source_link');
            $input['content'] = $request->input('content');
            $input['created_at'] = date('Y-m-d H:i:s');
            // $input['updated_at']  = date('Y-m-d H:i:s');

            $result = (new PostModel())->saveData(collect($input));

            if ($result) {
                $response['code'] = 1;
                $response['data'] = $result;
            }
            // print_r($input);
            return response($response, 200);
        }
        $data['categoryList'] = (new PostCategories())->getList();

        return view('admins.posts.add', $data);
    }

    /**
     * @param mixed $id
     */
    public function edit(Request $request, $id = 0)
    {
        if (null !== $request->input('title')) {
            $response = [
                'code' => 0,
                'msg' => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['platform'] = 'posts';
            $input['category'] = $request->input('category', '');

            $input['title'] = $request->input('title');
            $input['source_name'] = $request->input('source_name', '网络');
            $input['source_link'] = $request->input('source_link');
            $input['content'] = $request->input('content');
            // $input['created_at']  = date('Y-m-d H:i:s');
            $input['updated_at'] = date('Y-m-d H:i:s');

            $where = [
                'id' => $id,
            ];
            $result = DB::table('ks_posts')
                ->where($where)
                ->update($input)
            ;
            if ($result) {
                $response['code'] = 1;
            }
            // print_r($input);
            return response($response, 200);
        }

        $result = (new PostModel())->find($id);
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }

        $data['categoryList'] = (new PostCategories())->getList();

        $result = $result->toArray();
        $data['detail'] = $result;

        return view('admins.posts.edit', $data);
    }
}
