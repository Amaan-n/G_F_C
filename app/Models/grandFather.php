<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Father;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GrandFather extends Model // Capitalized class name
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['name', 'age', 'email'];

    public function fathers() // Corrected relationship method name
    {
        return $this->hasMany(Father::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'age', 'email'])
            ->useLogName('GrandFather Activity');
    }
}


