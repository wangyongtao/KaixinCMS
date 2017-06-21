<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//use App\Http\Controllers\BaseController;
use App\Models\WebsiteModel;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        return $this->showList($request);
    }
    /**
     * 首页
     * @return \Illuminate\View\View
     */
    public function showList(Request $request)
    {
        $page = $request->get('page', 0);
        $data = [];
        $where = [];
        $result = (new WebsiteModel())->getList($where, $page);

        $data['listData'] = $result;

        return view('websites.list', $data);
    }

    /**
     * 首页
     * @return \Illuminate\View\View
     */
    public function showListByArea(Request $request, $area = '')
    {
        $data = [];
        
        $page = $request->get('page', 0);

        //条件
        $where = [];
        if ($area) {
            $where['area'] = urldecode($area);
        }


        $result =  (new WebsiteModel())->getList($where, $page);

        $data['listData'] = $result;

        return view('websites.list', $data);
    }

    /**
     * 首页
     * @return \Illuminate\View\View
     */
    public function showListByIndustry(Request $request, $industry = '')
    {
        $data = [];
        $page = $request->get('page', 0);
       
        //条件
        $where = [];
        if ($industry) {
            $where['industry'] =urldecode($industry);
        }

        $result = (new WebsiteModel())->getList($where, $page);

        $data['listData'] = $result;

        return view('websites.list', $data);
    }
}
