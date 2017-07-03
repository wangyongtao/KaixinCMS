<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Cache;

class FeedbackModel extends BaseModel {

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = \Config::get('admins.tablePrefix') . \Config::get('admins.tableName.feedback');
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

 
}
