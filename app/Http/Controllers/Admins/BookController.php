<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Controllers\Admins\AdminController;
use Illuminate\Support\Facades\DB;

use App\Models\Books\BooksModel;
use App\Models\Books\BookSectionsModel;
use App\Models\Books\BookTextsModel;
use App\Http\FormBuilders;

class BookController extends AdminController
{
    /**
     * 列表
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

        $result = (new BooksModel())->getListWithPaginate($where, $page);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }
        // $data['categoryList'] = (new BookSectionsModel())->getList();
        // $data['categoryCount'] = (new PostModel())->getListGroupByCategory();

        $data['listData'] = $result;
// print_r($data);exit;

        return view('admins.books.bookList', $data);
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
            $input['category'] = $request->input('category', '');

            $input['book_name']     = $request->input('book_name');
            $input['book_name_en']  = $request->input('book_name_en');
            $input['book_description'] = $request->input('book_description');
            $input['notes'] = $request->input('notes');
            $input['created_at']    = date('Y-m-d H:i:s');
            // $input['updated_at']  = date('Y-m-d H:i:s');

            $result = (new BooksModel())->saveData(collect($input));

            if ($result) {
                $response['code'] = 1;
                $response['data'] = [
                    'id'  => $result,
                    'url' => '/admins/books/edit/'.$result,
                ];
            }
        // print_r($input);
            return response($response, 200);

        }
        $data = [];
        $data['configs']= $this->getYamlContent(config_path('admins/books.yaml'));
// print_r($booksConfig);
        // $data['categoryList'] = (new CategoryModel())->getList();
        // $data['parentCategoryList'] = (new CategoryModel)->getParentCategoryList();
        $data['options'] = array();
        // $data['options']['parent_id'] = collect($data['parentCategoryList'])->mapWithKeys(function($item){
        //     // print_r($item);
        //     return [$item['category_id'] => $item['category_name']];
        // });

        return view('admins.books.bookAdd', $data);
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
            $input = [];
            $input['platform'] = 'posts';
            $input['category'] = $request->input('category', '');

            $input['book_name']     = $request->input('book_name');
            $input['book_name_en']  = $request->input('book_name_en');
            $input['book_description'] = $request->input('book_description');
            $input['notes'] = $request->input('notes');
            $input['created_at']    = date('Y-m-d H:i:s');
            // $input['updated_at']  = date('Y-m-d H:i:s');
            $input['updated_at']  = date('Y-m-d H:i:s');



            $where = [
                'id' => $id,
            ];
            $result = (new BooksModel())->updateData($where, $input);
            if ($result) {
                $response['code'] = 1;
                $response['data'] = [
                    'id'  => $id,
                    'url' => '/admins/books/edit/'.$id,
                ];
            }
        // print_r($input);
            return response($response, 200);
        }

        $result = (new BooksModel())->findOrFail($id);
        // print_r($result->toArray());exit;
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        // $data['categoryList'] = (new PostCategoryModel())->getList();
        $data['configs']= $this->getYamlContent(config_path('admins/books.yaml'));

        $data['detail'] = $result->toArray();


        return view('admins.books.bookEdit', $data);
    }

}