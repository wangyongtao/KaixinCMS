<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Admins\AdminController;
// use Symfony\Component\Yaml\Yaml;
// use Symfony\Component\Yaml\Exception\ParseException;
use Illuminate\Support\Facades\DB;

use App\Models\Post\PostModel;
use App\Models\CategoryModel;

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
		$categoryMenu = collect($data['categoryList'])->where('parent_id', 0)->groupBy('platform');
		// print_r($categoryMenu);exit;

		$data['categoryMenu'] = $categoryMenu->toArray();
 
        return view('admins.categories.list', $data);
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
            $input['module']   = $request->input('module', '');
            $input['parent_id'] = $request->input('parent_id', 0);
            $input['category_name']   = $request->input('category_name', '');
            $input['category_name_en']   = $request->input('category_name_en', '');
            if ($request->input('notes', '')) {
                $input['notes'] = $request->input('notes', '');
            }
            $input['created_at']  = date('Y-m-d H:i:s');
            // $input['updated_at']  = date('Y-m-d H:i:s');

            $result = (new CategoryModel())->add(collect($input));

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
        
        return view('admins.categories.add', $data);
    }

        /**
     *
     */
    public function edit(Request $request, $id=0)
    {

// try {
//     $content = Yaml::parse(file_get_contents(config_path('admins/category.yaml')));
//     print_r($content);
// } catch (ParseException $e) {
//     printf("Unable to parse the YAML string: %s", $e->getMessage());
// }

        if ( $request->input('_submit') !== null ) {
            $response = [
                'code' => 0,
                'msg'  => '',
                'data' => [],
                'time' => time(),
            ];
            $input = [];
            $input['platform'] = 'posts';
            $input['module']   = $request->input('module', '');
            $input['parent_id'] = $request->input('parent_id', 0);
            $input['category_name']   = $request->input('category_name', '');
            $input['category_name_en']   = $request->input('category_name_en', '');
            if ($request->input('notes', '')) {
                $input['notes'] = $request->input('notes', '');
            }
            $input['updated_at']  = date('Y-m-d H:i:s');



            $where = [
                'category_id' => $id,
            ];
            $result = DB::table('ks_categories')
                ->where($where)
                ->update($input);
            if ($result) {
                $response['code'] = 1;
            }
        // print_r($input);
            return response($response, 200);
        }

        $result = (new CategoryModel())->find($id);
        if (empty($result)) {
            return "没有获取到数据.请确认URL是否正确.";
        }

        $result = $result->toArray();
        $data['detail'] = $result;
        $data['parentCategoryList'] = (new CategoryModel)->getParentCategoryList();

// print_r($data['parentCategoryList']);
        
        $data['options'] = array();
        $data['options']['parent_id'] = collect($data['parentCategoryList'])->mapWithKeys(function($item){
            // print_r($item);
            return [$item['category_id'] => $item['category_name']];
        });
//         print_r($data['options']);
// exit;

        return view('admins.categories.edit', $data);
    }

}