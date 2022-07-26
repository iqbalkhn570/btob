<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
class Menu extends Model
{
	use Sortable;
    use Loggable;

        public $sortable = ['title','created_at'];
    
    //
	///protected $fillable = [
       // 'title', 'status'
    //];

}
