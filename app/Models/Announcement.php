<?php
namespace App\Models;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Model;


class Announcement extends Model
{
	//public $timestamps = false;
    use Sortable;

        //public $sortable = ['name'];
    //
	///protected $fillable = [
       // 'title', 'status'
    //];

}

