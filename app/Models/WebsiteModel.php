<?php
namespace App\Models;

use App\Http\Models\Model as CoreModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class WebsiteModel extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ks_rank_websites';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function __construct()
    {
    }


    public function getList($where = [], $page = 0)
    {
        $cacheKey = sprintf('data_websites_%s_%s', date('YmdHis'), json_encode(func_get_args()));
        if (($result = Cache::get($cacheKey) ) === null) {
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
            if (isset($where['area']) && $where['area']) {
                $condition['area'] = $where['area'];
            }
            if (isset($where['industry']) && $where['industry']) {
                $condition['industry'] = $where['industry'];
            }
            $condition['status'] = 1;

            $result = self::select('*')
                ->where($condition)
                ->simplePaginate();

            Cache::put($cacheKey, $result, $minutes = 1);
        }

        return $result->toArray();
    }

    public function getHotList()
    {
        $where = [
            'status' => 1,
        ];
        $result =  $this->getList($where);
        
        return (isset($result['data']) && $result['data']) ? $result['data'] : [];
    }
}
