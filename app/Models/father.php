<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\child;
use App\Models\grandFather;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class father extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = ['name', 'age', 'email'];
    public function childs()
    {
        return $this->hasMany(child::class);
    }

    public function grandfathers()
    {
        return $this->belongsTo(grandFather::class, 'grand_fathers_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'age']);
            // ->logOnlyDirty();
    }
}
