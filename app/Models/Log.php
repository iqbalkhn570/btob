<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Log extends Model
{
	public $timestamps = false;
    protected $table="activity_logs";
	use Sortable;
    public $sortable = ['countryName','created_at','updated_at'];
    //
	///protected $fillable = [
       // 'title', 'status'
    //];
    public function Users(){
        return $this->belongsTo('App\Models\User','uid', 'id');
    }
    
}
