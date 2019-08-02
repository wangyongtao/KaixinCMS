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
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Model extends EloquentModel
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var table
     */
    protected $table = '';

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function saveData($input = [])
    {
        if ($input instanceof Collection) {
            $input = $input->toArray();
        }

        return self::table($this->table)->insertGetId($input);
    }

    public function updateData(array $where, array $input = [])
    {
        return self::where($where)->update($input);
    }

    public function insert(array $input = [])
    {
        if (empty($input)) {
            return false;
        }

        return self::instertGetId($input);
    }

    public function getListWithPaginate($where = [], $select = '*', $page = 0, $pageSize = 20)
    {
        $minutes = 1;
        $cacheKey = sprintf('cache_%_%s_%s', $this->table, date('YmdHis'), json_encode(\func_get_args()));
        if (null === ($result = Cache::get($cacheKey))) {
            info('cache: '.$cacheKey);
            // $result Array(
            //     [per_page] => 15
            //     [current_page] => 1
            //     [next_page_url] => http://wang123.app/link?page=2
            //     [prev_page_url] =>
            //     [from] => 1
            //     [to] => 15
            //     [data] => Array()
            // )
            $select = '*';
            if ($select) {
                $select = \is_array($select) ? implode(',', $select) : (string) $select;
            }

            $result = self::select(DB::raw($select))
                ->where($where)
                ->orderBy('id', 'desc')
                ->simplePaginate()
            ;

            if ($where) {
                $result->appends($where)->links();
            }

            Cache::put($cacheKey, $result, $minutes);
        }

        return $result->toArray();
    }

    protected function formatCacheKey($function, $input)
    {
        return sprintf('cache_%s_%s_%s_%s', $this->table, $function, date('Ymd'), md5(json_encode($input)));
    }
}
