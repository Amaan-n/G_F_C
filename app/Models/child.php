<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class child extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = ['name', 'email', 'age'];

    public function father()
    {
        return $this->belongsTo(father::class, 'fathers_id');
    }
    public function grandfathers()
    {
        return $this->belongsTo(grandFather::class, 'grand_fathers_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'age', 'email','grand_fathers_id','fathers_id'])->logOnlyDirty(); 
    }

}
