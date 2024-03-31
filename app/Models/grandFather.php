<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class GrandFather extends Model 
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['name', 'age', 'email'];

    public function fathers() 
    {
        return $this->hasMany(Father::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'age', 'email'])->logOnlyDirty(); 
    }
}