<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Models\Admins;

use App\Models\BaseModel;

class UserOperationLogs extends BaseModel
{
    /**
     * @var string
     *             The table name
     */
    protected $table = 'user_operations';
}
