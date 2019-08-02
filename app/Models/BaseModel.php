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
use Yadakhov\InsertOnDuplicateKey;

class BaseModel extends EloquentModel
{
    // The function is implemented as a trait.
    // https://github.com/yadakhov/insert-on-duplicate-key
    use InsertOnDuplicateKey;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

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

    public function setTableName($tableName = '', $tablePrefix = '')
    {
        $tableList = \Config::get('site-tables.tableName');
        if (empty($tablePrefix)) {
            $tablePrefix = \Config::get('site-tables.tablePrefix');
        }
        $tableName = !empty($tableList[$tableName]) ? $tableList[$tableName] : '';

        return $this->table = $tablePrefix.$tableName;
    }

    /**
     * 保存.
     *
     * @param Collection $input
     * @param int        $id
     *
     * @return int
     */
    public function store(Collection $input, int $id = 0): int
    {
        if ($id > 0) {
            $this->findOrFail($id)->update($input->toArray());
            Cache :: forget(sprintf('%s_%d', \get_class($this), $id));
        } else {
            $id = self :: create($input->toArray())->{$this->primaryKey};
        }

        Cache::tags($this->table)->flush();

        return $id;
    }

    /**
     * 保存.
     *
     * @param array $input
     *
     * @return int
     */
    public function saveData($input = [])
    {
        return $this->insertData($input, false);
    }

    /**
     * @param array $input
     *
     * @return bool|int
     */
    public function saveMultiData($input = [])
    {
        return $this->insertData($input, true);
    }

    /**
     * 保存.
     *
     * @param array $input
     * @param bool  $isMulti
     *
     * @return bool|int
     */
    public function insertData($input = [], $isMulti = false)
    {
        if ($input instanceof Collection) {
            $input = $input->toArray();
        }

        if ($isMulti) {
            return self::insert($input);
        }

        return self::insertGetId($input);
    }

    /**
     * 更新.
     *
     * @param array $where
     * @param array $input
     *
     * @return bool
     */
    public function updateData(array $input, array $where)
    {
        return self::where($where)->update($input);
    }

    /**
     * @param int $id
     * @param $
     * @param mixed $isUseCache
     * @param mixed $cacheMinutes
     *
     * @return array
     */
    public function getDetailById($id = 0, $isUseCache = true, $cacheMinutes = 60)
    {
        if ($id) {
            $result = $this->findOrFail($id)->toArray();
        }

        return $result;
    }

    public function deleteByPk(int $id)
    {
        $checkout = self::where($this->primaryKey, $id)->value('id');
        if (!$checkout) {
            return response()->json();
        }

        return response()->json([
            'data' => self::where($this->primaryKey, $id)->update(['status' => 0]),
        ]);
    }

    /**
     * 获取简单的数据列表.
     *
     * @param null|Collection $input
     * @param int             $cacheMinutes
     *
     * @return Collection
     */
    public function getSimpleDataList(Collection $input = null, $cacheMinutes = 0)
    {
        $isUseCache = $cacheMinutes > 0 ? true : false;
        $cacheKey = sprintf('cache_%_%s_%s', $this->table, date('Ymd'), md5(json_encode(\func_get_args())));
        if (false === $isUseCache || null === ($result = Cache::get($cacheKey))) {
            info('----> cache key: '.$cacheKey);
            if (null === $input) {
                $input = collect([]);
            }
            $pageSize = $input->get('pageSize', 20);
            $total = $this->getDataCount($input);

            $result = collect([]);
            $result['dataList'] = $this->getDataList($input);
            $result['dataTotal'] = $total;
            $result['pageSize'] = $pageSize;
            $result['totalPage'] = (!empty($total) && !empty($pageSize)) ? (int) ceil($total / $pageSize) : 0;
            $result['currentPage'] = max($input->get('page', 0), 1);

            Cache::put($cacheKey, $result, $cacheMinutes);
        }

        return collect($result);
    }

    /**
     * 列表.
     *
     * @param null|Collection $input
     * @param bool|true       $isUseCache
     * @param int             $minutes
     *
     * @return Collection
     */
    public function getListData(Collection $input = null, $isUseCache = true, $minutes = 60)
    {
        $cacheKey = sprintf(
            'cache_%_%s_%s',
            $this->table,
            date('YmdH'),
            md5(json_encode($input->toArray()))
        );
        if (false === $isUseCache || null === ($result = Cache::get($cacheKey))) {
            info('cache: '.$cacheKey);
            if (null === $input) {
                $input = collect([]);
            }
            $where = $input->get('where', []);
            $select = $input->get('select', '*');
            $orderBy = $input->get('orderBy', [$this->primaryKey => 'desc']);
            $limit = $input->get('limit', '20');
            if ($select) {
                $select = \is_array($select) ? implode(',', $select) : (string) $select;
            }

            $model = self::select(DB::raw($select));
            // WHERE
            if ($where) {
                foreach ($where as $key => $val) {
                    if (\is_array($val)) {
                        $model->whereIn($key, $val);
                    } else {
                        $model->where($key, $val);
                    }
                }
            }
            // ORDER BY
            if ($orderBy && \is_array($orderBy)) {
                foreach ($orderBy as $key => $val) {
                    $val = strtoupper($val);
                    if ('DESC' === $val || 'ASC' === $val) {
                        $model->orderBy($key, $val);
                    }
                }
            }
            // $model->orderBy('id', 'desc');
            // LIMIT
            $model->limit($limit);
            // RESULT
            $result = $model->get();

            $result = $result->toArray();

            Cache::put($cacheKey, $result, $minutes);
        }

        return collect($result);
    }

    // $result Array(
    //     [per_page] => 15
    //     [current_page] => 1
    //     [next_page_url] => http://wang123.app/link?page=2
    //     [prev_page_url] =>
    //     [from] => 1
    //     [to] => 15
    //     [data] => Array()
    // )

    public function getListAll(Collection $input)
    {
        $minutes = 0;
        $cacheKey = sprintf(
            'cache_%_%s_%s',
            $this->table,
            date('YmdH'),
            md5(json_encode($input))
        );
        if (null === ($result = Cache::get($cacheKey))) {
            $select = $input->get('select', '*');
            if ($select) {
                $select = \is_array($select) ? implode(',', $select) : (string) $select;
            }
            $where = $input->get('where', []);
            $orderBy = $input->get('orderBy', []);

            $model = self::select(DB::raw($select));
            $model->where($where);
            if ($orderBy) {
                foreach ($orderBy as $key => $val) {
                    $model->orderBy($key, $val);
                }
            } else {
                $model->orderBy($this->primaryKey, 'desc');
            }
            $result = collect($model->get())->toArray();

            Cache::put($cacheKey, $result, $minutes);
        }

        return $result;
    }

    /**
     * 获取列表(带分页).
     *
     * @param Collection $input
     *
     * @return mixed
     */
    public function getListWithPaginate(Collection $input = null)
    {
        if (null === $input) {
            $input = collect();
        }
        $minutes = 0;
        $cacheKey = sprintf(
            'cache_%_%s_%s',
            $this->table,
            date('YmdH'),
            md5(json_encode($input))
        );
        if (null === ($result = Cache::get($cacheKey))) {
            $select = $input->get('select', '*');
            if ($select) {
                $select = \is_array($select) ? implode(',', $select) : (string) $select;
            }
            $where = $input->get('where', []);
            $pageSize = $input->get('pageSize', 20);
            $orderBy = $input->get('orderBy', []);

            $model = self::select(DB::raw($select));
            $model->where($where);
            if ($orderBy) {
                foreach ($orderBy as $key => $val) {
                    $model->orderBy($key, $val);
                }
            } else {
                $model->orderBy($this->primaryKey, 'desc');
            }
            $result = $model->simplePaginate($pageSize);

            if ($where) {
                $where = collect($where)->except([
                    'status',
                    'user_id',
                ])->toArray();
                $where ? $result->appends($where)->links() : '';
            }
            $result = $result->toArray();

//             // 如果结果含用户uid, 获取用户名称
//             if (isset($result['data'][0]) && isset($result['data'][0]['user_id'])) {
//                 $userIds = collect($result['data'])->pluck('user_id')->unique();
//                 $userList = \App\User::select(DB::raw('id,name,nickname'))
//                     ->whereIn('id', $userIds)
//                     ->get();
//                 if ($userList) {
//                     $userResult = [];
//                     foreach ($userList as $key => $val) {
//                         $userResult[$val->id] = [
//                             'userId' => $val->id,
//                             'userName' => $val->name,
//                             'userNickname' => $val->nickname,
//                         ];
//                     }
//                     $result['data'] = collect($result['data'])->map(function($item) use ($userResult) {
//                         $uid = $item['user_id'];
//                         $item['user_name'] = $userResult[$uid]['userName'] ?? '';
//                         $item['user_nickname'] = $userResult[$uid]['userNickname'] ?? '';
//                         return $item;
//                     })->toArray();
//                 }
//             }

            Cache::put($cacheKey, $result, $minutes);
        }

        return $result;
    }

    /**
     * @param Collection $input
     *
     * @return Collection
     */
    protected function getDataList(Collection $input)
    {
        $where = $input->get('where', []);
        $select = $input->get('select', '*');
        $orderBy = $input->get('orderBy', [$this->primaryKey => 'desc']);
        if ($select) {
            $select = \is_array($select) ? implode(',', $select) : (string) $select;
        }
        $model = self::select(DB::raw($select));
        // WHERE
        if ($where) {
            foreach ($where as $key => $val) {
                if (\is_array($val)) {
                    $model->whereIn($key, $val);
                } else {
                    $model->where($key, $val);
                }
            }
        }
        // ORDER BY
        if ($orderBy && \is_array($orderBy)) {
            foreach ($orderBy as $key => $val) {
                $val = strtoupper($val);
                if ('DESC' === $val || 'ASC' === $val) {
                    $model->orderBy($key, $val);
                }
            }
        }
        // LIMIT OFFSET
        $currentPage = $input->get('page', 0);
        $pageSize = $input->get('pageSize', 10);
        $offset = $currentPage > 1 ? ($currentPage - 1) * $pageSize : 0;
        $model->limit($pageSize);
        $model->offset($offset);

        $result = $model->get();

        // RESULT
        return collect($result)->toArray();
    }

    /**
     * @param Collection $input
     *
     * @return Collection
     */
    protected function getDataCount(Collection $input)
    {
        $where = $input->get('where', []);
        $model = self::select('*');
        // WHERE
        if ($where) {
            foreach ($where as $key => $val) {
                if (\is_array($val)) {
                    $model->whereIn($key, $val);
                } else {
                    $model->where($key, $val);
                }
            }
        }
        $result = $model->count();

        // RESULT
        return (int) $result;
    }

    /**
     * @param string $function
     * @param $input
     *
     * @return string
     */
    protected function formatCacheKey($function, $input)
    {
        return sprintf('cache_%s_%s_%s_%s', $this->table, $function, date('Ymd'), md5(json_encode($input)));
    }
}
