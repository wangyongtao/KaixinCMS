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

class BookSections extends BaseModel
{
    /**
     * @var string
     *             The table name
     */
    protected $table = 'book_sections';

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}
