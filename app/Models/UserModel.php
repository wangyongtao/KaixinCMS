<?php

namespace Watercart\Admins;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Cache;

class UserModel extends Model {

    /**
     * @var string
     * The table name
     */
    protected $table;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->table = \Config::get('admins.tablePrefix') . \Config::get('admins.tableName.users');
        $this->table = \Config::get('admins.tableName.users');
    }

    public function getListWithPaginate($where = [], $page = 0)
    {
        $cacheKey = sprintf( 'cache_%_%s_%s', $this->table, date('YmdHis'), json_encode(func_get_args()) );
        if ( ($result = Cache::get($cacheKey) ) === null ) {
            info('cache: ' . $cacheKey);
            // $result Array(
            //     [per_page] => 15
            //     [current_page] => 1
            //     [next_page_url] => http://wang123.app/link?page=2
            //     [prev_page_url] => 
            //     [from] => 1
            //     [to] => 15
            //     [data] => Array()
            // )
            $condition = [];
            // if (isset($where['area']) && $where['area']) {
            //     $condition['area'] = $where['area'];
            // }
            if (isset($where['category']) && $where['category']) {
                $condition['category'] = $where['category'];
            }
            // $condition['status'] = 1;

            if (isset($where['select']) && $where['select']) {
                $select = $where['select'];
            } else {
                $select = '*';
            }

            $result = self::select( DB::raw($select) )
                ->where($condition)
                ->orderBy('id', 'desc')
                ->simplePaginate();

            if ($where) {
                $result->appends($where)->links();
            } 

            Cache::put($cacheKey, $result, $minutes=1);
        }

        return $result->toArray();
    }

}