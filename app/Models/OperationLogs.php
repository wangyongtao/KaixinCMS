<?php

namespace Watercart\Admins;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Cache;

class Logs extends Model {

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
        $this->table = \Config::get('admins.tablePrefix') . \Config::get('admins.tableName.operation_logs');
    }

}