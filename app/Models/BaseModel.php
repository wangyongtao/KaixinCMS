<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Cache;

class BaseModel extends EloquentModel
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
     * constructor
     */
    public function __construct(){
        parent::__construct();
    }

    protected function formatCacheKey($function='', $input) {
        return sprintf('cache_%s_%s_%s_%s', $this->table, $function, date('Ymd'), md5(json_encode($input)));
    }

    public function saveData(Collection $input){
        return DB::table($this->table)->insertGetId($input->toArray());
    }



    public function getListWithPaginate($where = [], $select = '*', $page = 0, $pageSize = 20)
    {
        $minutes = 1;
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
            $select = '*';
            if ($select) {
                $select = is_array($select) ? implode(',', $select) : strval($select);
            }

            $result = self::select( DB::raw($select) )
                ->where($where)
                ->orderBy('id', 'desc')
                ->simplePaginate();

            if ($where) {
                $result->appends($where)->links();
            }

            Cache::put($cacheKey, $result, $minutes);
        }

        return $result->toArray();
    }
}
