<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Cache;
use App\Models\BaseModel;

class PostsTagsModel extends BaseModel 
{

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
        $this->table = \Config::get('admins.tablePrefix') . \Config::get('admins.tableName.posts');
    }

}