<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Watercart\Admins\Posts as PostModel;
use Watercart\Admins\Categories as CategoryModel;
use App\Http\Controllers\Admins\AdminController;

class PostController extends AdminController
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

        $result = (new PostModel())->getListWithPaginate($where, $page);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        $data['categoryList'] = (new CategoryModel())->getList();
        // $data['categoryCount'] = (new PostModel())->getListGroupByCategory();
// print_r($data);exit;

        $data['listData'] = $result;

        return view('admins.posts.list', $data);
    }


    /**
     *
     */
    public function add(Request $request)
    {

        if ( $request->input('title') !== null ) {
            $response = [
                'code' => 0,
                'msg'  => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['type']     = 101;
            $input['category'] = $request->input('category');

            $input['title']    = $request->input('title');
            $input['source']   = $request->input('source');
            $input['content']  = $request->input('content');
            $input['update_time'] = time();

            $result = DB::table('posts')->insertGetId($input);

            if ($result) {
                $response['code'] = 1;
                $response['data'] = $result;
            }
        // print_r($input);
            return response($response, 200);

        }
        $data['categoryList'] = (new CategoryModel())->getList();

        return view('admins.posts.add', $data);
    }

        /**
     *
     */
    public function edit(Request $request, $id=0)
    {
        if ( $request->input('title') !== null ) {
            $response = [
                'code' => 0,
                'msg'  => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['type']     = 101;
            $input['category'] = $request->input('category');
            $input['title']    = $request->input('title');
            $input['source']   = $request->input('source');
            $input['content']  = $request->input('content');
            $input['status']   = 1;
            $input['update_time'] = time();


            $where = [
                'id' => $id,
            ];
            $result = DB::table('posts')
                ->where($where)
                ->update($input);
            if ($result) {
                $response['code'] = 1;
            }
        // print_r($input);
            return response($response, 200);
        }

        $result = (new PostModel())->find($id);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        $data['categoryList'] = (new CategoryModel())->getList();

        $result = $result->toArray();
        $data['detail'] = $result;


        return view('admins.posts.edit', $data);
    }

}