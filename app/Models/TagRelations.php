<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Models\Post;

use App\Models\BaseModel;

class TagRelations extends BaseModel
{
    /**
     * @var string
     *             The table name
     */
    protected $table = 'tag_relations';
}
