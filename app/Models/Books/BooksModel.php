<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Cache;
use App\Models\BaseModel;

class BooksModel extends BaseModel 
{


    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // $this->table = \Config::get('admins.tablePrefix') . \Config::get('admins.tableName.posts');
        $this->table = 'kx_books';
    }

}
