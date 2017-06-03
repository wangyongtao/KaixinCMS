<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

use App\Models\ArticleModel;

class SitemapController extends Controller
{
    public function __construct(){

    }
    /**
     * 首页
     * @return \Illuminate\View\View
     */
    public function showXml()
    {
//         $data = [];
//         $result = DB::table('cms_articles')
//             ->select(DB::raw('id, title, create_time'))
//             ->where('status', 1)->get();
// // print_r($result);exit;
//         $data['data'] = $result->toArray();
        $minutes = 0;
        $posts = Cache::remember('sitemap.sitemap-xml', $minutes, function () {
            // $posts = ArticleModel::all();
            // print_r($posts);exit;
            $posts = DB::table('cms_articles')
                ->select(DB::raw('id, title, update_time'))
                ->where('status', 1)->get();
            // return generated xml (string) , cache whole file
            // return view('sitemap.sitemap-xml', compact('posts'))->render();
            return $posts;
        });
        $jokes = Cache::remember('sitemap.sitemap-xml', $minutes, function () {
            // $posts = ArticleModel::all();
            // print_r($posts);exit;
            $posts = DB::table('cms_jokes')
                ->select(DB::raw('id, title, update_time'))
                ->where('status', 1)->get();
            // return generated xml (string) , cache whole file
            // return view('sitemap.sitemap-xml', compact('posts'))->render();
            return $posts;
        });
        $data['posts'] = $posts ;
        $data['jokes'] = $jokes ;
        return response(view('sitemap.sitemap-xml', $data)->render())->header('Content-Type', 'text/xml');
    }

}
