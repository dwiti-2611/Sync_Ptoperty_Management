<?php

namespace App;

use App\Sell;

use App\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_unique_id',
        'branch_id',
        'flat_type',
        'floor_number',
        'flat_size',
        'unite_price',
        'total_flat_price',
        'car_parking_charge',
        'utility_charge',
        'additional_work_charge',
        'other_charge',
        'discount_or_deduction',
        'refund_additional_work_charge',
        'net_sells_price',
        'description',
        'product_img',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function sell()
    {
        return $this->hasOne(Sell::class, 'product_id', 'product_unique_id');
    }
}
