<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Country extends Model
{
	public $timestamps = false;
	use Sortable;

        public $sortable = ['name'];
    
    //
	///protected $fillable = [
       // 'title', 'status'
    //];
    public function Users(){
        return $this->hasMany('App\Models\User','uid', 'id');
    }
   
        

}
