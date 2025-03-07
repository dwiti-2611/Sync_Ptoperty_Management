<?php

namespace App;

use App\Branch;
use App\Product;
use App\Customer;
use App\Employee;
use App\ActualReceived;
use App\ScheduleReceivable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sell extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'customer_id',
        'branch_id',
        'product_id',
        'employee_id',
        'sells_date',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_unique_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function schedule_receivables()
    {
        return $this->hasMany(ScheduleReceivable::class, 'sells_id', 'id');
    }

    public function actual_receives()
    {
        return $this->hasMany(ActualReceived::class, 'sells_id', 'id');
    }
}
