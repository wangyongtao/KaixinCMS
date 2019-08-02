<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Models\Books;

use App\Models\BaseModel;

class Books extends BaseModel
{
    /**
     * @var string
     *             The table name
     */
    protected $table = 'books';

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}
