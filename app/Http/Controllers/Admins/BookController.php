<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers\Admins;

use App\Models\Books\Books;
use Illuminate\Http\Request;

class BookController extends AdminController
{
    /**
     * 列表.
     *
     * @return string
     */
    public function index(Request $request)
    {
        return $this->list($request);
    }

    public function list(Request $request)
    {
        $page = $request->input('page', 0);
        $category = $request->input('category', '');
        $data = [];
        $where = [];
        if ($category) {
            $where['category'] = $category;
        }

        $result = (new Books())->getListWithPaginate(collect([
            'where' => $where,
            'page' => $page,
        ]));
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }
        // $data['categoryList'] = (new BookSectionsModel())->getList();
        // $data['categoryCount'] = (new PostModel())->getListGroupByCategory();

        $data['listData'] = $result;
        // print_r($data);exit;

        return view('admins.books.bookList', $data);
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
            $input['category'] = $request->input('category', '');

            $input['book_name'] = $request->input('book_name');
            $input['book_name_en'] = $request->input('book_name_en');
            $input['book_description'] = $request->input('book_description');
            $input['notes'] = $request->input('notes');
            $input['created_at'] = date('Y-m-d H:i:s');
            // $input['updated_at']  = date('Y-m-d H:i:s');

            $result = (new Books())->saveData(collect($input));

            if ($result) {
                $response['code'] = 1;
                $response['data'] = [
                    'id' => $result,
                    'url' => '/admins/books/edit/'.$result,
                ];
            }
            // print_r($input);
            return response($response, 200);
        }
        $data = [];
        $data['configs'] = $this->getYamlContent(config_path('admins/books.yaml'));
        // print_r($booksConfig);
        // $data['categoryList'] = (new Categories())->getList();
        // $data['parentCategoryList'] = (new Categories)->getParentCategoryList();
        $data['options'] = [];
        // $data['options']['parent_id'] = collect($data['parentCategoryList'])->mapWithKeys(function($item){
        //     // print_r($item);
        //     return [$item['category_id'] => $item['category_name']];
        // });

        return view('admins.books.bookAdd', $data);
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
            $input = [];
            $input['platform'] = 'posts';
            $input['category'] = $request->input('category', '');

            $input['book_name'] = $request->input('book_name');
            $input['book_name_en'] = $request->input('book_name_en');
            $input['book_description'] = $request->input('book_description');
            $input['notes'] = $request->input('notes');
            $input['created_at'] = date('Y-m-d H:i:s');
            // $input['updated_at']  = date('Y-m-d H:i:s');
            $input['updated_at'] = date('Y-m-d H:i:s');

            $where = [
                'id' => $id,
            ];
            $result = (new Books())->updateData($where, $input);
            if ($result) {
                $response['code'] = 1;
                $response['data'] = [
                    'id' => $id,
                    'url' => '/admins/books/edit/'.$id,
                ];
            }
            // print_r($input);
            return response($response, 200);
        }

        $result = (new Books())->findOrFail($id);
        // print_r($result->toArray());exit;
        if (empty($result)) {
            return '没有获取到数据.请确认URL是否正确.';
        }

        // $data['categoryList'] = (new PostCategories())->getList();
        $data['configs'] = $this->getYamlContent(config_path('admins/books.yaml'));

        $data['detail'] = $result->toArray();

        return view('admins.books.bookEdit', $data);
    }
}
