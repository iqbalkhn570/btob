<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
class OddsSetting extends Model
{
    use Loggable, Notifiable, HasRoles;
    use Sortable;
    protected $fillable = [
        ''
    ];
    //
}
