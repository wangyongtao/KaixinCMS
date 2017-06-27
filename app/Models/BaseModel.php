<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

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
}
