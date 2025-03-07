<?php

namespace App;

use App\Sell;
use Illuminate\Database\Eloquent\Model;

class ScheduleReceivable extends Model
{
    protected $fillable = [
        'sells_id',
        'term',
        'payable_amount',
        'schedule_date',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function sell()
    {
        return $this->belongsTo(Sell::class, 'sells_id', 'id');
    }
}
