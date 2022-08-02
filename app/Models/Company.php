<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Kyslik\ColumnSortable\Sortable;
class Company extends Model
{
    use HasFactory;
    use Loggable;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name','slug'
    ];

    public function brands (){
        return $this->belongsToMany(Brand::class, 'brand_company')->where('brands.status','enabled')->orderBy('brands.name','ASC')->withPivot('status');
    }
}