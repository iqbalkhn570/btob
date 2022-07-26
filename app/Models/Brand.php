<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    use HasFactory;
    use Loggable;
    use Sortable;
    use  SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    public function getBrandImage(){
      
        if( !empty($this->image)  && file_exists(public_path('/frontend/images/brand/'.$this->image) ) ){
            return asset('/public/frontend/images/brand/'.$this->image);
        }else{
            return false;
        }
    }

}