<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Posts\Posts;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends BaseController
{
    /**
     * 网站地图首页.
     *
     * @throws \Throwable
     *
     * @return \Illuminate\View\View
     */
    public function showXml()
    {
        $data = [];
        // 获取文件列表
        $data['posts'] = $this->getPostList();

        return response(
            view('sitemap.sitemap-xml', $data)->render()
        )->header('Content-Type', 'text/xml');
    }

    /**
     * @throws \Throwable
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function showHtml()
    {
        $data = [];
        // 获取文件列表
        $data['posts'] = $this->getPostList();

        return response(
            view('sitemap.sitemap-html', $data)->render()
        );
    }

    /**
     * 获取文章列表.
     *
     * @return mixed [type] [description]
     */
    protected function getPostList()
    {
        $minutes = 5;
        $cacheKey = sprintf('cache-key-site-map-xml-%s', date('YmdH'));

        return Cache::remember($cacheKey, $minutes, function () {
            return (new Articles())
                ->select(['id', 'title', 'created_at', 'updated_at'])
                ->where('status', 1)
                ->get()
            ;
            // return generated xml (string) , cache whole file
            // return view('sitemap.sitemap-xml', compact('posts'))->render();
        });
    }
}
