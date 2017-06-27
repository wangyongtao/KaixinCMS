<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DictRootModel;
use App\Models\DictWordModel;

class DictController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return view('home');
    }

    public function getWordList(){
        $result['dict'] = (new DictWordModel())->getListWithPaginate();
        return view('home');
    }


    public function getRootList()
    {

        $result['dict'] = (new DictRootModel())->getListWithPaginate();
        return view('home');
    }
}
