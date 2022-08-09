<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Lottery extends Model
{
    use HasFactory;
    use Loggable;
    use Sortable;
    // use SoftDeletes;
    protected $table="customer_lotteries";
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'reference_number','customer_id','company_id','number_pattern','big_bet_amount','small_bet_amount','bet_type','total_amount'
    ];
    

}