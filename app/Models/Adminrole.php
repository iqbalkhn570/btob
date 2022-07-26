<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Adminrole extends Model
{
    use Sortable;
    use Loggable;
    protected $table = "roles";

    public $sortable = ['name', 'created_at', 'updated_at'];

    //protected $table = 'users';

    //
    public function Users()
    {
        $this->hasMany('App\Models\User', 'role_id', 'id');
    }

}
