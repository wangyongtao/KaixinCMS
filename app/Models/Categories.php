<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    protected $primaryKey = 'category_id';

    /**
     * @var string
     *             The table name
     */
    protected $table = 'categories';

    public function get(int $id)
    {
        $where = [
            'id' => $id,
            'status' => 1,
        ];

        return DB::table($this->table)->where($where)->get();
    }

    public function getList($where = [])
    {
        $cacheKey = $this->formatCacheKey(__FUNCTION__, \func_get_args());
        $minutes = 1;
        $data = Cache::remember($cacheKey, $minutes, function () use ($where) {
            $condition = $where;
            if (isset($where['status']) && $where['status']) {
                $condition['status'] = 1;
            }
            if (isset($where['is_has_image']) && $where['is_has_image']) {
                $condition['is_has_image'] = 1;
            }

            $result = self::select('*')
                ->where($condition)
                ->orderBy('category_id', 'desc')
                ->get()
            ;

            // // 构造图片地址
            // $uploadModel = new UploadModel();
            // $result = collect($result)->map(function($item) use ($uploadModel){
            //     $item['imageUrl'] = '';
            //     if ($item['image']) {
            //         $item['imageUrl'] = UploadModel::getUrl($item['image']);
            //     }
            //     return $item;
            // });
            return $result->toArray();
        });

        return $data;
    }

    public function getListByPlatform($platform = '')
    {
        $where = [];
        $where['platform'] = $platform;

        return $this->getList($where);
    }

    public function getListByModule($module = '')
    {
        $where = [];
        $where['module'] = $module;

        return $this->getList($where);
    }

    public function getParentCategoryList()
    {
        $where = [];
        $where['parent_id'] = 0;

        return $this->getList($where);
    }
}
