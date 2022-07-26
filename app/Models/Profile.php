<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
class Profile extends Model
{
	use Sortable;
    use Loggable;

        public $sortable = ['name','email','created_at'];
    
	protected $table = 'users';

    //
}
