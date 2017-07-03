<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Cache;

class PostModel extends BaseModel {

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = \Config::get('admins.tablePrefix') . \Config::get('admins.tableName.posts');
    }

    public function get(int $id)
    {
        $where = [
            'id'      => $id,
            'status'  => 1,
        ];
        return DB::table($this->table)->where($where)->get();
    }

    /**
     * 获取列表数据
     *
     * @param Collection $where
     * @param int $limit
     * @return mixed
     */
    public function getList(Collection $where, $limit = 10) : Collection
    {
        $cacheKey = sprintf( 'cache_%_%s_%s', $this->table, date('YmdHis'), json_encode(func_get_args()) );
        if ( ($result = Cache::get($cacheKey) ) === null ) {
            info('cache: ' . $cacheKey);
            $condition = [];
            // if (isset($where['area']) && $where['area']) {
            //     $condition['area'] = $where['area'];
            // }
            if (isset($where['category']) && $where['category']) {
                $condition['category'] = $where['category'];
            }
            $condition['status'] = 1;

            if (isset($where['select']) && $where['select']) {
                $select = $where['select'];
            } else {
                $select = '*';
            }

            $result = self::select( DB::raw($select) )
                ->where($condition)
                ->orderBy('id', 'desc')
                ->limit($limit)
                ->get();

            Cache::put($cacheKey, $result, $minutes=1);
        }

        return $result;
    }

    /**
     * 根据分类获取每个分类的文章
     *
     * @return static
     */
    public function getListGroupByCategory($where = [])
    {
        $cacheKey = $this->formatCacheKey(__FUNCTION__, func_get_args());
        $minutes = 1;
        $result = Cache::remember($cacheKey, $minutes, function () use ($where) {

            $data = [];
            $data['count'] = $this->getListCountGroupByCategory($where);
            $data['list']  = $this->getListDataGroupByCategory($where);

            if ($data) {
                Cache::put($cacheKey, $data, $minutes);
            }
        });
        return $result;
    }

    private function getListDataGroupByCategory($where)
    {
        $condition = [];
        if (isset($where['category']) && $where['category']) {
            $condition['category'] = $where['category'];
        }
        // if (isset($where['industry']) && $where['industry']) {
        //     $condition['industry'] = $where['industry'];
        // }
        // $condition['status'] = 1;

        $result = collect($categoryResult)->map(function($item, $key){
            $where = collect([
                'select'   => 'id, title, category',
                'category' => $key,
            ]);

            $res = $this->getList($where);

            if ($res->isEmpty()) {
                return false;
            }

            return $res->sortByDesc('id')->toArray();
        });

        return $result;
    }
    /**
     * 获取每个分类下的文章数量
     * @return mixed
     */
    public function getListCountGroupByCategory($where)
    {
        $condition = [];
        if (isset($where['category']) && $where['category']) {
            $condition['category'] = $where['category'];
        }
        // if (isset($where['industry']) && $where['industry']) {
        //     $condition['industry'] = $where['industry'];
        // }
        // $condition['status'] = 1;

        $result = self::select(DB::raw('category, count(*) AS total'))
            ->where($condition)
            ->groupBy('category')
            ->get();

        if ($result) {
            $result = $result->mapWithKeys(function($item){
                return [$item['category'] => $item['total']];
            })->toArray();
        }
        return $result;
    }
}
