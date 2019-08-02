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

class BookTexts extends BaseModel
{
    /**
     * @var string
     *             The table name
     */
    protected $table = 'book_texts';

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}
