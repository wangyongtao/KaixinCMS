<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Model;

class UserOperationLogs extends Model
{
    /**
     * @var string
     *             The table name
     */
    protected $table;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->table = \Config::get('admins.tablePrefix').\Config::get('admins.tableName.operation_logs');
    }
}
